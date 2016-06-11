@extends('layouts.admin')

@section('content')
    <h2>Create Post</h2>

    @include('includes.form_error')

    {!! Form::open(['method'=>'post','action'=>'AdminPostsController@store','files'=>true]) !!}

        <div class="form-group">
            {!! Form::label('title','Post Title: ') !!}
            {!! Form::text('title',null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('category_id','Category: ') !!}
            {!! Form::select('category_id',[''=>'Select Category','1'=>'laravel'],null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('photo_id','Photo: ') !!}
            {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('body','Post Title: ') !!}
            {!! Form::textarea('body',null,['class'=>'form-control','rows'=>5]) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create Post',['class'=>'btn btn-primary'])!!}
        </div>

    {!! Form::close() !!}

@stop