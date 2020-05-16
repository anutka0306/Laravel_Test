@extends('layouts.main')
@section('content')

    @include('common.errors')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <h2>CATEGORIES!</h2>
                        <div class="row">
                            @foreach ($categories as $category)

                                <div class="col-md-4">
                                    <a href="{{ route('Category', $category->slug) }}"><h2>{{ $category->name }}</h2></a>
                                    <a href="#">
                                        <div class="catalog-item__image" style="background-image:url({{ $category->image }})" alt=""></div>
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
