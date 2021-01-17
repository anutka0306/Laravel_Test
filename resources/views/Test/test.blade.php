@extends('layouts.main')
@section('content')

    @include('common.errors')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Test info</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>{{ $test->name }}</h2>
                            </div>

                            <div class="col-md-12">
                                <p>{{ $test->description }}</p>
                            </div>
                        </div>

                        <div class="row">

                                <div class="col-md-12">
                                    @foreach($questions as $question)
                                    <h3>{{ $question->question }}</h3>

                                        @endforeach
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

