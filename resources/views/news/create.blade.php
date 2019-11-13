@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <h1>
            News
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                {{-- <div class="row">
                    <div class="form-group col-sm-12" style="height: 600px;">
                        <div id="fm"></div>
                    </div>
                </div> --}}
                <div class="row">
                    {!! Form::open(['route' => 'news.store', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}

                        @include('news.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
@endsection