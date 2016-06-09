@extends('layouts.admin')

@section('content')

    <h2>Edit Users</h2>
    <hr>

    @include('includes.form_error')

    <div class="col-md-4"><img src="{{$user->photo?$user->photo->file:'images/dp.jpg'}}" alt="" class="img-responsive img-rounded"></div>

    <div class="col-md-8">

    {!! Form::model($user,['method'=>'PATCH','action'=>['AdminUsersController@update',$user->id],'files'=>true]) !!}

    <div class="form-group">
        {!! Form::label('name','Name:') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email','Email:') !!}
        {!! Form::email('email',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password','Password:') !!}
        {!! Form::password('password',['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('role_id','Role:') !!}
        {!! Form::select('role_id',$roles,null,['placeholder'=>'Pick one','class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('is_active','Status:') !!}
        {!! Form::select('is_active',[0 =>'Not Active',1 =>'Active'],null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('photo_id','Photo:') !!}
        {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Update User',['class'=>'btn btn-primary']) !!}

    </div>

    {!! Form::close() !!}
    </div>


@stop