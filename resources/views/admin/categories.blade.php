@extends('layouts.admin')
@section('content')

    @include('common.errors')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Редактирование категорий</div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                            <a href="{{ route("admin.categories.create") }}">
                                <button class="btn btn-success">Создать категорию</button>
                            </a>
                            </div>
                            @foreach ($categories as $category)

                                <div class="col-md-6">
                                    <div class="catalog-item__image_thumb" style="background-image:url({{ $category->image }})" alt=""></div>
                                    <a href="{{ route('Category', $category->slug) }}"><h2>{{ $category->name }}</h2></a>

                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}">
                                        <button class="btn btn-info">Редактировать</button>
                                    </a>
                                    <a href="#">
                                        <button class="btn btn-danger">Удалить</button>
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

