@extends("layouts.admin")
@section("content")


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" enctype="multipart/form-data" action="
@if(!$test->id){{ route("admin.tests.store") }}
                        @else {{ route("admin.tests.update", $test->id) }}
                        @endif">
                            @csrf
                            @if($test->id)
                                @method('PATCH')
                            @endif

                            <div class="form-group">
                                <label for="testTitle">Название теста</label>
                                @if($errors->has('name'))
                                    <div class="alert alert-danger">
                                        @foreach($errors->get('name') as $error)
                                            {{$error}}
                                        @endforeach
                                    </div>
                                @endif
                                <input name="name" type="text" class="form-control" id="testTitle" value="{{ $test->name ?? old('name') }}">
                            </div>

                            <div class="form-group">
                                <label for="cat">Категория</label>
                                @if($errors->has('cat'))
                                    <div class="alert alert-danger">
                                        @foreach($errors->get('cat') as $error)
                                            {{$error}}
                                        @endforeach
                                    </div>
                                @endif
                                <select class="custom-select" name="cat">
                                    @foreach($cats as $cat)

                                       <option @if($test->cat == $cat->id)
                                                selected
                                                @endif
                                               name="cat" value="{{ $cat->id ?? old('cat')}}">{{ $cat->name ?? old('cat')}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="minPoint">Минимальный проходной балл</label>
                                @if($errors->has('min_pass_point'))
                                    <div class="alert alert-danger">
                                        @foreach($errors->get('min_pass_point') as $error)
                                            {{$error}}
                                        @endforeach
                                    </div>
                                @endif
                                <input name="min_pass_point" type="number" class="form-control" id="minPoint" value="{{ $test->min_pass_point ?? old('min_pass_point') }}">
                            </div>

                            <div class="form-group">
                                <label for="testDescription">Описание теста</label>
                                @if($errors->has('description'))
                                    <div class="alert alert-danger">
                                        @foreach($errors->get('description') as $error)
                                            {{$error}}
                                        @endforeach
                                    </div>
                                @endif
                                <textarea name="description" class="form-control" rows="5" id="my-editor">{{ $test->description ?? old('description') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Картинка теста</label><br>
                                @if($errors->has('image'))
                                    <div class="alert alert-danger">
                                        @foreach($errors->get('image') as $error)
                                            {{$error}}
                                        @endforeach
                                    </div>
                                @endif
                                <input type="file" name="image">
                                @if($test->image)
                                    <figure class="figure">
                                        <img src="{{$test->image}}" alt="..." width="200" class="img-thumbnail thumbnail200">
                                        <figcaption class="figure-caption">Текущее изображение</figcaption>
                                    </figure>
                                @endif
                            </div>

                            <h3><strong>Вопросы</strong></h3>
                            <div class="form-group">
                                @php($i = 0)
                                @foreach($questions as $question)
                                <label for="testTitle">Вопрос {{ ++$i }}</label>
                                @if($errors->has('question'))
                                    <div class="alert alert-danger">
                                        @foreach($errors->get('question') as $error)
                                            {{$error}}
                                        @endforeach
                                    </div>
                                @endif
                                <input name="questionIds[]" type="hidden" value="{{ $question->id }}">
                                <input name="questions[]" type="text" class="form-control" id="testQuestion_{{$i}}" value="{{ $question->question ?? old('question') }}">
                                    <p><strong>Ответы</strong></p>
                                    @foreach($answers[$question->id] as $answer)

                                        @if(!empty($answer))

                                        <div class="input-group mb-3" id="answer_{{ $answer['id'] }}">
                                            <input name="answerIds[]" type="hidden" value="{{ $answer['id'] }}" class="answerId">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Ответ & Балл  </span>
                                            </div>
                                        <input name="answers[]" type="text" class="form-control" value="{{ $answer['answer'] }}">
                                        <input name="answerPoints[]" type="number" class="form-control" value="{{ $answer['point'] }}">
                                            <div class="input-group-append">


                                                    <button class="btn btn-outline-secondary" type="button" data-id="{{ $answer['id'] }}"  onclick="deleteAnswer(this)">X</button>


                                            </div>
                                        </div>
                                        @endif
                                    @endforeach

                                    <div class="input-group mb-3" id="new-answer__block_{{ $question->id }}">

                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Ответ & Балл  </span>
                                        </div>
                                        <input class="newAnswer" type="text" class="form-control" value="">
                                        <input class="newPoints" type="number" class="form-control" value="">
                                        <div class="input-group-append">
                                            <button class="btn btn-info" type="button" data-questionid="{{ $question->id }}" onclick="createAnswer(this)">Добавить ответ</button>
                                        </div>

                                    </div>

                                    <hr>
                                @endforeach
                            </div>

                            <!-- Add Question -->
                            <div id="newQuestionBlock">
                                <label for="testTitle"><strong>Новый вопрос</strong></label>
                                <div class="input-group mb-2">
                                    <input id="test-id" type="hidden" value="
                                        @if(!$test->id)0
                                            @else {{ $test->id }}
                                        @endif
                                        ">
                                    <input id="newQuestion" type="text" class="form-control" value="">
                                    <div class="input-group-append">
                                        <button class="btn btn-danger" type="button" onclick="createNewQuestion(this)">Добавить Вопрос</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary" value="@if($test->id)Изменить @else Добавить @endif тест"
                                       id="addTest">
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function deleteAnswer(obj) {

                let id = $(obj).data("id");
                let token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                    url: "/admin/answers/"+id,
                    type: 'DELETE',
                    data: {_token: token, id: id},
                    success: function (){
                        $("#answer_"+id).remove();
                    },
                });
        }

        function createAnswer(obj) {
            let questionId = $(obj).data("questionid");
            let answer = $(obj).parent().siblings('.newAnswer').val();
            let points = $(obj).parent().siblings('.newPoints').val();
            let token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: "/admin/answers/",
                type: 'POST',
                data: {_token: token,
                    question_id: questionId,
                    answer: answer,
                    point: points
                },
                success: function (response){
                    let lastBlock = $("#new-answer__block_"+questionId);
                    let newAnswerBlock = "<div class='input-group mb-3' id='answer_"+ response+"'>" +
                       "<input name='answerIds[]'type='hidden' value='"+response+"' class=\"answerId\">" +
                        " <div class='input-group-prepend'>" +
                        " <span class='input-group-text'>Ответ & Балл  </span>" +
                        " </div>" +
                        " <input name='answers[]' type='text' class='form-control' value='"+answer+"'>" +
                        " <input name='answerPoints[]' type='number' class='form-control' value='"+points+"'>" +
                        " <div class='input-group-append'>" +

                        "<button class='btn btn-outline-secondary' type='button' data-id='"+response+"'  onclick='deleteAnswer(this)'>X</button>" +

                        " </div>" +
                        " </div>";

                    lastBlock.before(newAnswerBlock);
                    $("#new-answer__block_"+questionId+" .newAnswer").val('');
                    $("#new-answer__block_"+questionId+" .newPoints").val('');
                },
            });
        }

        function createNewQuestion(obj) {
            let newQuestion = $(obj).parent().siblings('#newQuestion').val();
            let testId = $(obj).parent().siblings('#test-id').val();
            let token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url: "/admin/questions/",
                type: 'POST',
                data: {
                    _token: token,
                    question: newQuestion,
                    test_id: testId,
                },
                success:function(response){
                    let lastBlock = $("#newQuestionBlock");
                    let newQuestionBlock ="<label for=\"testTitle\">Вопрос "+response+"</label>\n" +
                        "<input name=\"questionIds[]\" type=\"hidden\" value=\""+response+"\">\n" +
                        "<input name=\"questions[]\" type=\"text\" class=\"form-control\" id=\"testQuestion_"+response+"\" value=\""+newQuestion+"\">\n" +
                        "<p><strong>Ответы</strong></p>" +
                    "<div class=\"input-group mb-3\" id=\"new-answer__block_"+response+"\">\n" +
                        "\n" +
                        "<div class=\"input-group-prepend\">\n" +
                        "<span class=\"input-group-text\">Ответ & Балл  </span>\n" +
                        " </div>\n" +
                        "<input class=\"newAnswer\" type=\"text\" class=\"form-control\" value=\"\">\n" +
                        "<input class=\"newPoints\" type=\"number\" class=\"form-control\" value=\"\">\n" +
                        "<div class=\"input-group-append\">\n" +
                        "<button class=\"btn btn-info\" type=\"button\" data-questionid=\""+response+"\" onclick=\"createAnswer(this)\">Добавить ответ</button>\n" +
                        "</div>\n" +
                        "\n" +
                        "</div>";
                    lastBlock.before(newQuestionBlock);
                    $("#newQuestion").val('');
                },
            });
        }
    </script>


    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
    </script>

    <script>
        CKEDITOR.replace('my-editor', options);
    </script>


@endsection
