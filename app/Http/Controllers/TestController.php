<?php

namespace App\Http\Controllers;
use Image;
use App\QuestionBank;
use App\TestQuestion;
use App\TestType;
use App\Test;
use App\User;
use App\MCQ;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function addTestFirstPage(){
        return view('backend.add_test_first');
    }

    public function createNewTestFirst(Request $request){

        // $test_author_image = null;
        // if ($request->hasFile('test_author_image')){
        //     $get_image = $request->file('test_author_image');
        //     $image_name = str::random(5) . time() . '.' . $get_image->getClientOriginalExtension();
        //     Image::make($get_image)->save('test_file/' . $image_name, 50);
        //     $test_author_image = "test_file/" . $image_name;
        // }

        $last_inserted_id = Test::insertGetId([
            "user_id" => Auth::user()->id,
            "test_name" => $request->test_name,
            "test_type" => $request->test_type,
            "test_summary" => $request->test_summary,
            // "test_description" => $request->test_description,
            "test_level" => $request->test_level,
            // "test_time" => $request->test_time == '' ? 0 : $request->test_time,
            // "test_audience" => $request->test_audience,
            // "test_author_image" => $test_author_image,
            // "test_author_name" => $request->test_author_name,
            // "test_author_description" => $request->test_author_description,
            "slug" => time().str::random(5),
            'created_at' => Carbon::now()
        ]);

        session(['last_inserted_id' => $last_inserted_id]);

        if(Auth::user()->type == 1){
            if($request->story_based == 1){
                return view('backend.story_based_test');
            }
            else{
                return redirect('/add/question/to/test');
            }
        }
        else{
            return view('backend.story_based_test');
        }

    }

    public function addQuestionToTest(){
        $questions = QuestionBank::orderBy('id','desc')->paginate(90);
        return view('backend.addQuestionToTest',compact('questions'));
    }

    public function createTestSecond(Request $request){

        $inserted_test_id = session('last_inserted_id');
        $test_info = Test::where('id',$inserted_test_id)->first();

        $total_marks = 0;
        $total_test_time = 0;
        foreach($request->question as $question){
            $question_info = QuestionBank::where('slug',$question)->first();
            $total_marks = $total_marks+$question_info->marks;
            $total_test_time = $total_test_time + $question_info->time;
            TestQuestion::insert([
                "test_id" => $inserted_test_id,
                "test_slug" => $test_info->slug,
                "question_id" => $question_info->id,
                "question_slug" => $question_info->slug,
                "created_at" => Carbon::now(),
            ]);
        }

        Test::where('id',$inserted_test_id)->update([
            'total_marks' => $total_marks,
            'test_time' => $total_test_time
        ]);

        $request->session()->forget('last_inserted_id');

        Toastr::success('Test has been Created', 'Success');
        return redirect("/view/all/tests");

    }

    public function createStoryBasedTest(Request $request){

        $inserted_test_id = session('last_inserted_id');
        $test_info = Test::where('id',$inserted_test_id)->first();

        Test::where('id',$test_info->id)->increment('total_marks', $request->marks);
        Test::where('id',$test_info->id)->increment('test_time', $request->time);

        $questionBank = new QuestionBank();
        $questionBank->user_id = Auth::user()->id;
        $questionBank->question_type = $request->question_type;
        $questionBank->passage = $request->passage;
        $questionBank->question = $request->question;
        $questionBank->marks = $request->marks;
        $questionBank->time = $request->time;
        $questionBank->is_active = 1;
        $questionBank->slug = time().str::random(5);
        $questionBank->batch = trim($request->batch);
        $questionBank->created_at = Carbon::now();
        $questionBank->save();

        if($request->question_type == 1){
            foreach($request->mcq as $mcq){
                MCQ::insert([
                    "question_id" => $questionBank->id,
                    "mc" => $mcq,
                    "created_at" => Carbon::now(),
                ]);
            }
            QuestionBank::where('id',$questionBank->id)->update([
                "answer" => $request->answer[0]
            ]);
        }

        if($request->question_type == 2){
            QuestionBank::where('id',$questionBank->id)->update([
                "answer" => $request->editor
            ]);
        }

        if($request->question_type == 3){
            foreach($request->mcq as $mcq){
                MCQ::insert([
                    "question_id" => $questionBank->id,
                    "mc" => $mcq,
                    "created_at" => Carbon::now(),
                ]);
            }
            if($request->hasFile('question_file')){
                $fileName = time().str::random(5).'.'.$request->question_file->extension();
                $request->question_file->move('question_file/', $fileName);
            }
            QuestionBank::where('id',$questionBank->id)->update([
                "answer" => $request->answer[0],
                "question_file" => "question_file/".$fileName
            ]);
        }

        if($request->question_type == 4){
            if($request->hasFile('question_file')){
                $fileName = time().str::random(5).'.'.$request->question_file->extension();
                $request->question_file->move('question_file/', $fileName);
            }
            QuestionBank::where('id',$questionBank->id)->update([
                "answer" => $request->editor,
                "question_file" => "question_file/".$fileName
            ]);
        }

        if($request->question_type == 5){
            QuestionBank::where('id',$questionBank->id)->update([
                "answer" => $request->codeEditor,
                "pl_code" => $request->programming_language,
            ]);
        }

        TestQuestion::insert([
            "test_id" => $inserted_test_id,
            "test_slug" => $test_info->slug,
            "question_id" => $questionBank->id,
            "question_slug" => $questionBank->slug,
            "created_at" => Carbon::now(),
        ]);

        return response()->json(['success'=>'Test Created successfully.']);
    }

    public function viewAllTests(){

        $tests = DB::table('tests')
                    ->join('users','tests.user_id','=','users.id')
                    ->leftJoin('test_types','tests.test_type','=','test_types.id')
                    ->where([['users.type',1],['tests.is_active',1]])
                    ->orWhere([['user_id', Auth::user()->id],['tests.is_active',1]])
                    ->orderBy('tests.id','desc')
                    ->select('tests.*','users.type as user_type','users.name as user_name','test_types.title as test_type_title')
                    ->paginate(30);

        return view('backend.view_test',compact("tests"));
    }

    public function getDataOfTest($slug){

        $data = DB::table('tests')
                    ->join('test_types','tests.test_type','=','test_types.id')
                    ->join('users','tests.user_id','=','users.id')
                    ->select('tests.*','test_types.title','users.name as user_name')
                    ->where('tests.slug',$slug)
                    ->first();

        $no_of_questions = TestQuestion::where('test_id',$data->id)->count();

        $info = DB::table('test_questions')
                ->join('question_banks','test_questions.question_id','=','question_banks.id')
                ->select('question_banks.question')
                ->where('test_questions.test_id',$data->id)
                ->get();

        $str = null;
        $i = 1;

        if(Auth::user()->id == $data->user_id){
            if(count($info) >= 1){
                $str .= "<ul>";
                foreach($info as $item){
                    $str .="<li>".$i.". ". $item->question. "</li>";
                    $i++;
                }
                $str .= "</ul>";
            }
        }

        $test_types = TestType::orderBy('title','asc')->get();
        $test_types_lists = "<option value=''>Select One</option>";

        if(count($test_types) > 0){
            foreach($test_types as $test_type){
                if($test_type->id == $data->test_type){
                    $test_types_lists .= "<option value='".$test_type->id."' selected>".$test_type->title."</option>";
                }
                else{
                    $test_types_lists .= "<option value='".$test_type->id."'>".$test_type->title."</option>";
                }
            }
        }

        $test_level = null;
        if($data->test_level == 1){
            $test_level = "Beginner";
        }
        elseif($data->test_level == 2){
            $test_level = "Intermediate";
        }
        else{
            $test_level = "Expert";
        }

        $test_level_lists = "<option value=''>Select One</option>";
        if($data->test_level == 1){
            $test_level_lists .= "<option value='1' selected>Beginner</option>";
        }
        else{
            $test_level_lists .= "<option value='1'>Beginner</option>";
        }
        if($data->test_level == 2){
            $test_level_lists .= "<option value='2' selected>Intermediate</option>";
        }
        else{
            $test_level_lists .= "<option value='2'>Intermediate</option>";
        }
        if($data->test_level == 3){
            $test_level_lists .= "<option value='3' selected>Expert</option>";
        }
        else{
            $test_level_lists .= "<option value='3'>Expert</option>";
        }

        return response()->json(['data'=> $data, 'str' => $str, 'no_of_questions' => $no_of_questions, 'test_types' => $test_types_lists, "test_level" => $test_level, 'test_level_lists' => $test_level_lists]);
    }

    public function updateTest(Request $request){
        Test::where('slug',$request->test_slug)->update([
            "test_name" => $request->test_name,
            "test_type" => $request->test_type,
            "test_summary" => $request->test_summary,
            // "test_description" => $request->test_description,
            "test_level" => $request->test_level,
            "test_time" => $request->test_time,
            // "test_audience" => $request->test_audience,
            // "test_author_name" => $request->test_author_name,
            // "test_author_description" => $request->test_author_description,
            'updated_at' => Carbon::now()
        ]);
        return response()->json(['success'=>'Product saved successfully.']);
    }

    public function deleteTest($slug){
        // $data = Test::where('slug',$slug)->first();
        // TestQuestion::where('test_id',$data->id)->delete();
        // if($data->test_author_image != null){
        //     if(file_exists(public_path($data->test_author_image))){
        //         unlink($data->test_author_image);
        //     }
        // }
        // Test::where('slug',$slug)->delete();
        Test::where('slug',$slug)->update([
            'is_active' => 0,
            'updated_at' => Carbon::now()
        ]);
        return response()->json(['success'=>'Test deleted successfully.']);
    }

    public function searchTest(Request $request){
        if($request->ajax())
        {
            if($request->search != ""){
                $output = "";
                $tests = DB::table('tests')
                            ->join('users','tests.user_id','=','users.id')
                            ->where('tests.test_name','LIKE','%'.$request->search.'%')
                            ->whereRaw(" (users.type = 1 || tests.user_id = ".Auth::user()->id.") ")
                            ->where('is_active',1)
                            ->select('tests.*', 'users.type as user_type')
                            ->limit(30)
                            ->get();

            }else{
                $output = "";
                $tests = DB::table('tests')
                            ->join('users','tests.user_id','=','users.id')
                            ->whereRaw(" (users.type = 1 || tests.user_id = ".Auth::user()->id.") ")
                            ->where('is_active',1)
                            ->orderBy('tests.id','desc')
                            ->select('tests.*','users.type as user_type')
                            ->limit(30)
                            ->get();
            }

            if($tests){
                foreach ($tests as $key => $test) {

                    $test_head = "";
                    $test_side_head = "";
                    if($test->user_type != 1){
                        $test_side_head = "<h3 style='font-size: 17px'><i class='far fa-user-circle'></i></h3>";
                    }

                    if($test->test_level == 1){
                        $test_head .= "<i class='fas fa-bars'></i> Easy";
                    }
                    elseif($test->test_level == 2){
                        $test_head .= "<i class='fas fa-chart-bar'></i> Intermediate";
                    }
                    else{
                        $test_head .= "<i class='fas fa-qrcode'></i> Expert";
                    }

                    if(strlen($test->test_name) > 65){
                        $test_name = substr($test->test_name,0,64)."...";
                    }
                    else{
                        $test_name = $test->test_name;
                    }

                    $buttons = "<a href='javascript:void(0)' data-toggle='tooltip' data-id='".$test->slug."' data-original-title='Preview' class='preview previewTest'><i class='far fa-eye'></i> Preview</a>";
                    if(Auth::user()->id == $test->user_id){
                        $buttons .= "<a href='javascript:void(0)' data-toggle='tooltip' data-id='$test->slug' data-original-title='Edit' class='edit editTest'><i class='fas fa-file-signature'></i> Edit</a><a href='javascript:void(0)' data-toggle='tooltip' data-id='$test->slug' data-original-title='Delete' class='deleteTest'><i class='fas fa-trash-alt'></i> Delete</a>";
                    }

                    $output .= "<div class='col-lg-4 text-center' id='test_".$test->slug."'>
                    <div class='card' style='height: 345px'>
                        <div class='card-header text-left'>
                            <div class='row p-0 m-0'>
                                <div class='col-lg-6 p-0 m-0'>
                                    <h3>".$test_head."<h3>
                                </div>
                                <div class='col-lg-6 p-0 m-0 text-right text-white'>".$test_side_head."</div>
                            </div>
                        </div>
                        <div class='card-body text-left bg-white'>
                            <h3 id='test_slug_".$test->slug."'>".$test_name."</h3>
                            <p style='margin-bottom: 20px; height: 160px;'>".substr($test->test_summary,0,200)."</p>
                            <div class='row'>
                                <div class='col-lg-12 text-center'>".$buttons."</div>
                            </div>
                        </div>
                    </div>
                    </div>";
                }
                return Response($output);
            }
        }
    }

    public function searchTestForAssesment(Request $request){
        if($request->ajax())
        {
            if($request->search != ""){
                $output = "";
                $tests = DB::table('tests')->where('test_name','LIKE','%'.$request->search."%")->OrderBy('id','desc')->limit(30)->get();
            }else{
                $output = "";
                $tests = DB::table('tests')->OrderBy('id','desc')->paginate(30);
            }

            if($tests){
                foreach ($tests as $key => $test) {

                    $test_head = "";
                    if($test->test_level == 1){
                        $test_head .= "<i class='fas fa-bars'></i> Easy";
                    }
                    elseif($test->test_level == 2){
                        $test_head .= "<i class='fas fa-chart-bar'></i> Intermediate";
                    }
                    else{
                        $test_head .= "<i class='fas fa-qrcode'></i> Expert";
                    }

                    if(strlen($test->test_name) > 65){
                        $test_name = substr($test->test_name,0,64)."...";
                    }
                    else{
                        $test_name = $test->test_name;
                    }

                    $output .= "<div class='col-lg-4 text-center' id='test_".$test->slug."'><div class='card' style='height: 305px'><div class='card-header text-left'><h3>".$test_head."<h3></div><div class='card-body text-left'><h3 id='test_slug_".$test->slug."'>".$test_name."</h3><p style='margin-bottom: 20px'><b>Created By -</b> ".User::where('id',$test->user_id)->first()->name."<br><b>Author Name -</b> ".$test->test_author_name."<br><b>No. of Questions -</b> ".TestQuestion::where('test_id',$test->id)->count()."</p><p style='margin-bottom: 20px'><div class='row'><div class='col-lg-8'><b>Type -</b> ".TestType::where('id',$test->test_type)->first()->title."</div><div class='col-lg-4'><b><i class='fas fa-history'></i></b> ".$test->test_time." Min</div></div></p><div class='row'><div class='col-lg-12 text-center'><a href='javascript:void(0)' data-toggle='tooltip' data-id='".$test->slug."' data-original-title='Preview' class='preview previewTest'><i class='far fa-eye'></i> Preview</a> <a href='javascript:void(0)' id='".$test->slug."'  onclick='addTestToTheAssesment(this.id)'><i class='fas fa-plus-circle'></i> Add to Assesment</a></div></div></div></div></div>";
                }
                return Response($output);
            }
        }
    }

    public function getAllPl(){
        $languages = DB::table("programming_languages")->orderBy('name','asc')->get();
        return response()->json($languages);
    }
}
