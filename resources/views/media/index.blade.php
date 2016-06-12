@extends('layouts.admin');

@section('content')

    <h2>Media</h2>

    <table class="table">
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Created at</th>
        </tr>
        @foreach($photos as $photo)
        <tr>
            <td>{{$photo->id}}</td>
            <td><img height="50" src="{{$photo->file}}" alt=""></td>
            <td>{{$photo->created_at?$photo->created_at->diffForHumans():"N/A"}}</td>

            {{--Delete button--}}
            <td>
                {!! Form::open(['method'=>'delete','action'=>['MediaController@destroy',$photo->id]]) !!}
                    {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
         @endforeach
    </table>

@stop
