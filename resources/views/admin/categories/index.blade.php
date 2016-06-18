@extends('layouts.admin')

@section('content')


    <div class="col-md-6 create-category">
        <div class="row">
            <div class="col-md-3"><h2>Categories</h2></div>
            <div class="col-md-3 col-md-offset-6">
                <button class="btn btn-primary pull-right"><a style="color: white" href="{{route('admin.category.create')}}">Create Categories</a></button>
            </div>

        </div>

        {!! Form::open(['method'=>'post','action'=>'CategoriesController@store']) !!}

        <div class="form-group">
            {!! Form::label('name','Name: ') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create Category',['class'=>'btn btn-primary'])!!}
        </div>
        {!! Form::close() !!}
    </div>

    <div class="col-md-6 show-category">
        <h2>Categories</h2>
        <table class="table">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>

            @foreach($categories as $category)

                <tr>
                    <td>{{$category->id}}</td>
                    <td><a href="{{route('admin.category.edit',$category->id)}}">{{$category->name}}</a> </td>
                    <td>{{$category->created_at?$category->created_at->diffForhumans():'N/A'}}</td>
                    <td>{{$category->updated_at?$category->updated_at->diffForhumans():'N/A'}}</td>
                </tr>

            @endforeach
        </table>
    </div>

@stop