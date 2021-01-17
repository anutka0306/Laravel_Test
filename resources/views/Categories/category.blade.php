@extends('layouts.main')
@section('content')

    @include('common.errors')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                 <h2>{{ $category->name }}</h2>
                            </div>
                            <div class="col-md-3">
                                <div class="category-label__image" style="background-image:url({{ $category->image }})" alt="{{ $category->name }}"></div>
                            </div>
                            <div class="col-md-9">
                                <p>{!! $category->description !!}</p>
                            </div>
                        </div>

                        <div class="row">
                            @foreach($tests as $test)
                               <div class="col-md-3">
                                   <a href="{{ route('Test', $test->id) }}"> <h3>{{ $test->name }}</h3></a>
                                   <small>Min pass: {{ $test->min_pass_point }}</small>
                               </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

