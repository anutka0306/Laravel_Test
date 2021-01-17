@extends('layouts.admin')
@section('content')
    @include('common.errors')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <h2>Админ-панель</h2>
                        <div class="row">
                            Категории выбора действий или еще что-то
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

