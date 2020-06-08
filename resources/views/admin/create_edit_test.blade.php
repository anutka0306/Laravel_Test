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

                            <h3>Вопросы</h3>
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
                                @endforeach
                            </div>


                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary" value="@if($test->id)Изменить @else Добавить @endif категорию"
                                       id="addTest">
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

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
