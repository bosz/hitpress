@extends('layouts.admin')

@section('content')
    <h2>Edit Post</h2>

    @include('includes.form_error')

    {!! Form::model($post,['method'=>'patch','action'=>['AdminPostsController@update',$post->id],'files'=>true]) !!}

    <div class="form-group">
        {!! Form::label('title','Post Title: ') !!}
        {!! Form::text('title',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('category_id','Category: ') !!}
        {!! Form::select('category_id',$category,null,['class'=>'form-control']) !!}
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
        {!! Form::submit('Update Post',['class'=>'btn btn-primary'])!!}
    </div>

    {!! Form::close() !!}


@stop