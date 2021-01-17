@extends('layouts.admin')
@section('content')

    @include('common.errors')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Редактирование тестов</div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <a href="#">
                                    <button class="btn btn-success">Новый тест</button>
                                </a>
                            </div>
                            @foreach ($tests as $test)


                                <div class="col-md-4">
                                    <div class="catalog-item__image_thumb" style="background-image:url({{ $test->image }})" alt=""></div>
                                    <a href="#"><h2>{{ $test->name }}</h2></a>

                                </div>
                            <div class="col-md-2">
                                @if (array_key_exists($test->cat, $category->toArray()))
                                {{ $category[$test->cat] }}
                                @else
                                    Без категории
                                @endif
                            </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.tests.edit', $test->id) }}">
                                        <button class="btn btn-info">Редактировать</button>
                                    </a>
                                    <a href="#">
                                        <form method="post" action="#" style="display: inline">
                                            <button type="submit" class="btn btn-danger">Удалить</button>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


