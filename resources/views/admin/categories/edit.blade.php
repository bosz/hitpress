@extends('layouts.admin')

@section('content')


    <div class="col-md-6 create-category">
        <h2>Edit Category</h2>

        {!! Form::model($category,['method'=>'patch','action'=>['CategoriesController@update',$category->id]]) !!}

        <div class="form-group">
            {!! Form::label('name','Name: ') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Update Category',['class'=>'btn btn-primary'])!!}
        </div>
        {!! Form::close() !!}

        {{-- Delete Form( button)--}}

        {!! Form::open(['method'=>'delete','action'=>['CategoriesController@destroy',$category->id]]) !!}
        <div class="form-group">
            {!! Form::submit('Delete Category',['class'=>'btn btn-danger'])!!}
        </div>
        {!! Form::close() !!}


    </div>



@stop