@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Заказчики') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div id="app">
                        <table-component></table-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
