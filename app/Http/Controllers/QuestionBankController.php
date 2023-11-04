<?php

namespace App\Http\Controllers;
use App\QuestionBank;
use App\MCQ;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class QuestionBankController extends Controller
{
    public function addQuestionPage(){
        return view('backend.add_question');
    }

    public function createNewQuestion(Request $request){

        // MCQ Null Validation start
        if($request->question_type == 1 || $request->question_type == 3){
            foreach($request->mcq as $mcq){
                if($mcq == ''){
                    Toastr::error('Sorry! MCQ Option Cannot be Null', 'Success');
                    return redirect()->back();
                }
            }
        }
        // MCQ Null Validation end

        $questionBank = new QuestionBank();
        $questionBank->user_id = Auth::user()->id;
        $questionBank->question_type = $request->question_type;
        $questionBank->pl_code = $request->programming_language;
        $questionBank->question = $request->question;
        $questionBank->passage = $request->passage;
        $questionBank->marks = trim($request->marks);
        $questionBank->time = trim($request->time);
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
                "answer" => $request->editor1
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
                "answer" => $request->editor1,
                "question_file" => "question_file/".$fileName
            ]);
        }

        if($request->question_type == 5){
            QuestionBank::where('id',$questionBank->id)->update([
                "answer" => $request->codeEditor,
            ]);
        }

        Toastr::success('Question has been Created', 'Success');
        return redirect()->back();

    }

    public function viewAllQuestion(){
        if(Auth::user()->type == 1){
            $questions = QuestionBank::orderBy('id','desc')->paginate(30);
            return view("backend.view_questions",compact("questions"));
        }
        else{
            $questions = DB::table('question_banks')
                            ->join('users','question_banks.user_id','=','users.id')
                            ->where('question_banks.user_id',Auth::user()->id)
                            ->orWhere('users.type',1)
                            ->select('question_banks.*')
                            ->orderBy('id','desc')
                            ->paginate(30);
            return view("backend.view_questions",compact("questions"));
        }
    }

    public function getQuestionData($slug){
        $data = QuestionBank::where('slug',$slug)->first();
        $info = MCQ::where('question_id',$data->id)->get();
        $str = null;
        $i = 1;
        if(count($info) >= 1){
            $str .= "<ul>";
            foreach($info as $item){
                if($data->answer == $i){
                    $str .="<li>".$i.". ". $item->mc. " <i class='fas fa-check'></i></li>";
                }
                else{
                    $str .="<li>".$i.". ". $item->mc. "</li>";
                }
                $i++;
            }
            $str .= "</ul>";
        }

        return response()->json(['data'=> $data, 'str' => $str]);
    }

    public function deleteQuestion($slug){
        $data = QuestionBank::where('slug',$slug)->first();
        MCQ::where('question_id',$data->id)->delete();
        if($data->question_file != null){
            if(file_exists($data->question_file)){
                unlink($data->question_file);
            }
        }
        QuestionBank::where('slug',$slug)->delete();
        return response()->json(['success'=>'Question deleted successfully.']);
    }

    public function updateQuestion(Request $request){
        QuestionBank::where('slug',$request->slug)->update([
            'question' => $request->question,
            // 'marks' => $request->question_marks,
            'time' => $request->question_time,
            'updated_at' => Carbon::now()
        ]);
        return response()->json(['success'=>'Product saved successfully.']);
    }

    public function searchQuestion(Request $request){
        if($request->ajax())
        {
            if($request->search != ""){
                $output="";
                $questions=DB::table('question_banks')->where('question','LIKE','%'.$request->search."%")->OrderBy('id','desc')->limit(9)->get();

            }else{
                $output="";
                $questions=DB::table('question_banks')->OrderBy('id','desc')->get();
            }

            if($questions){
                foreach ($questions as $key => $question) {

                    $question_head = "";
                    if($question->question_type == 1){
                        $question_head = "<i class='fas fa-check'></i> MCQ";
                    }
                    elseif($question->question_type == 2){
                        $question_head = "<i class='far fa-edit'></i> Open Ended";
                    }
                    elseif($question->question_type == 3){
                        $question_head = "<i class='fas fa-check'></i> MCQ + <i class='far fa-file-alt'></i> File";
                    }
                    else{
                        $question_head = "<i class='fas fa-edit'></i> Open Ended + <i class='far fa-file-alt'></i> File";
                    }

                    if(strlen($question->question) > 65){
                        $question_title = substr($question->question,0,64)."...";
                    }
                    else{
                        $question_title = $question->question;
                    }

                    $output .= "<div class='col-lg-4 text-center' id='question_".$question->slug."'><div class='card' style='height: 240px'><div class='card-header text-left'><h3>".$question_head."</h3></div><div class='card-body text-left'><h3>".$question_title."</h3><p>By -".User::where('id',$question->user_id)->first()->name."</p><div class='row'><div class='col-lg-12 text-center'><a href='javascript:void(0)' data-toggle='tooltip' data-id='".$question->slug."' data-original-title='Preview' class='preview previewQuestion'><i class='far fa-eye'></i> Preview</a> <a href='javascript:void(0)' data-toggle='tooltip' data-id='".$question->slug."' data-original-title='Edit' class='edit editQuestion'><i class='fas fa-file-signature'></i> Edit</a> <a href='javascript:void(0)' data-toggle='tooltip'  data-id='".$question->slug."' data-original-title='Delete' class='deleteQuestion'><i class='fas fa-trash-alt'></i> Delete</a></div></div></div></div></div>";
                }
                return Response($output);
            }
        }
    }

    public function searchQuestionForAddToTest(Request $request){
        if($request->ajax())
        {
            if($request->search != ""){
                $output="";
                $questions=DB::table('question_banks')->where('question','LIKE','%'.$request->search."%")->OrderBy('id','desc')->limit(30)->get();

            }else{
                $output="";
                $questions=DB::table('question_banks')->OrderBy('id','desc')->paginate(30);
            }

            if($questions){
                foreach ($questions as $key => $question) {

                    $question_head = "";
                    if($question->question_type == 1){
                        $question_head = "<i class='fas fa-check'></i> MCQ";
                    }
                    elseif($question->question_type == 2){
                        $question_head = "<i class='far fa-edit'></i> Open Ended";
                    }
                    elseif($question->question_type == 3){
                        $question_head = "<i class='fas fa-check'></i> MCQ + <i class='far fa-file-alt'></i> File";
                    }
                    else{
                        $question_head = "<i class='fas fa-edit'></i> Open Ended + <i class='far fa-file-alt'></i> File";
                    }

                    if(strlen($question->question) > 65){
                        $question_title = substr($question->question,0,64)."...";
                    }
                    else{
                        $question_title = $question->question;
                    }

                    $output .= "<div class='col-lg-4 text-center' id='question_".$question->slug."'><div class='card' style='height: 240px'><div class='card-header text-left'><h3>".$question_head."</h3></div><div class='card-body text-left'><h3><input type='hidden' id='question_title_".$question->slug."' value='".$question->question."'>".$question_title."</h3><p>By -".User::where('id',$question->user_id)->first()->name."</p><div class='row'><div class='col-lg-12 text-center'><a href='javascript:void(0)' data-toggle='tooltip' data-id='".$question->slug."' data-original-title='Preview' class='preview previewQuestion'><i class='far fa-eye'></i> Preview</a> <a href='javascript:void(0)' id='".$question->slug."' onclick='addQuestionToTheTest(this.id)'><i class='fas fa-plus-circle'></i> Add to Test</a> </div></div></div></div></div>";
                }
                return Response($output);
            }
        }
    }

    public function searchProgrammingLanguage(Request $request){
    	$data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = DB::table('programming_languages')
                        ->where('name','LIKE',"%$search%")
                        ->limit(10)
                        ->get();
        }
        return response()->json($data);
    }

}
