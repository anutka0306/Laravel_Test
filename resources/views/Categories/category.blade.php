@extends('layouts.main')
@section('content')

    @include('common.errors')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <h2>IMYA CATEGORII</h2>
                        <div class="row">
                            @foreach($tests as $test)
                               <div class="col-md-3">
                                   <h3>{{ $test->name }}</h3>
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

