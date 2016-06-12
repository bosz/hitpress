@extends('layouts.admin');

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">

@stop


@section('content')
    <h2>Upload Images</h2>
    {!! Form::open(['action'=>'MediaController@store','class'=>'dropzone']) !!}



    {!! Form::close() !!}


@stop

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
@stop