@extends('backend.master')

@section('content')

    <form action="{{url('save/assesment/thirdstep')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- backend navigation start-->
        <section>
            <div class="backend_navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="navigation_title">
                                <h3>Add Custom Question (Step-3)</h3>
                                <b>Attach maximum 10 Custom Question to this Assement</b>
                            </div>
                        </div>
                        <div class="col-lg-6 text-right">
                            <div class="navigation_item pt-2">
                                <ul>
                                    <li class="active">
                                        <button type="submit" style="cursor: pointer">Next Step <i class="fas fa-arrow-right"></i></button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- backend navigation end-->

        <!-- question content start-->
        <section>
            <div class="single_assesment_content mb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="assesment_details">

                                <div class="row pb-5 pt-3">
                                    <div class="col-lg-3 text-center">
                                        <a class="btn btn-dark text-white" style="cursor:default">Step 1 : Set Title & Role</a> <i class="fas fa-arrow-right"></i>
                                    </div>
                                    <div class="col-lg-3 text-center">
                                        <a class="btn btn-dark text-white" style="cursor:default">Step 2 : Select Test</a> <i class="fas fa-arrow-right"></i>
                                    </div>
                                    <div class="col-lg-3">
                                        <a class="btn text-white" style="background: #226679;cursor:default">Step 3 : Add Question</a> <i class="fas fa-arrow-right" style="color: #226679"></i>
                                    </div>
                                    <div class="col-lg-3">
                                        <button class="btn btn-dark text-white" type="submit" style="cursor: pointer;box-shadow: 5px 5px 10px gray">Step 4 : Review & Configure</button>
                                    </div>
                                </div>

                                <span style="color: #23272B; font-size:13px;font-weight:500"><b>Add up to 10 custom questions to your assessment (optional).</b> You can use five question types: multiple-choice, essay, video, file upload and code. Tip: save time by interviewing remotely with video questions. You'll see how candidates communicate in their video responses.</span>

                                <br>

                                @if($count_question <= 10)
                                    <a href="{{url('add/custom/question/to/assesment')}}" style="display: inline-block; background: #226679; color:white;padding:8px 25px; margin-top: 10px; border-radius: 5px;">New Question</a>
                                @endif


                                <section>
                                    <div class="test" style="background: transparent">
                                        <div class="test_content">
                                            <div class="row wow fadeInUp" data-wow-duration="1.2s" id="question_coloumn">
                                                <div class="col-lg-12">
                                                    <table class="table table-striped">
                                                        <thead>
                                                          <tr>
                                                            <th scope="col">SL</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">Question</th>
                                                            <th scope="col">Marks</th>
                                                            <th scope="col">Time</th>
                                                            <th scope="col">Action</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i=1; ?>
                                                            @foreach ($questions as $question)
                                                            <tr id="question_no_{{$question->slug}}">
                                                                <th scope="row">
                                                                    {{$i++}}
                                                                    <input type="hidden" name="question_slug[]" value="{{$question->slug}}">
                                                                </th>
                                                                <td>
                                                                    @if($question->question_type == 1)
                                                                    <i class="fas fa-check"></i> MCQ
                                                                    @elseif($question->question_type == 2)
                                                                    <i class="far fa-edit"></i> Open Ended
                                                                    @elseif($question->question_type == 3)
                                                                    <i class="fas fa-check"></i> MCQ +
                                                                    <i class="far fa-file-alt"></i> File
                                                                    @elseif($question->question_type == 4)
                                                                    <i class="far fa-edit"></i> Open Ended +
                                                                    <i class="far fa-file-alt"></i> File
                                                                    @else
                                                                    <i class="fas fa-laptop-code"></i> Coding
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @php
                                                                    if(strlen($question->question) > 70){
                                                                        echo substr($question->question,0,70)."...";
                                                                    }
                                                                    else{
                                                                        echo $question->question;
                                                                    }
                                                                    @endphp
                                                                </td>
                                                                <td>
                                                                    <input type="number" style="padding: 3px; width: 100px" placeholder="Marks" value="{{$question->marks}}" name="marks[]" required>
                                                                </td>
                                                                <td>
                                                                    <input type="number" style="padding: 3px; width: 100px" placeholder="minute" name="time[]" required>
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$question->slug}}" data-original-title="Delete" class="btn btn-sm btn-danger deleteQuestion"><i class="fas fa-trash-alt"></i> Delete</a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- question content end-->

    </form>
@endsection


@section('footer_js')

<script type="text/javascript">


    $(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.deleteQuestion', function () {
            var slug = $(this).data('id');
            if(confirm("Are You sure want to delete !")){
                $.ajax({
                    type: "GET",
                    url: "{{ url('/delete/question') }}"+'/'+slug,
                    success: function (data) {
                        $("#question_no_"+slug).css("display","none");
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        });

    });
</script>

@endsection
