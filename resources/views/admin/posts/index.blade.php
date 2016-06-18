@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3"><h2>Posts</h2></div>
        <div class="col-md-3 col-md-offset-6">
            <button class="btn btn-primary pull-right"><a style="color: white" href="{{route('admin.post.create')}}">Create Posts</a></button>
        </div>

    </div>

    @if(Session::has('deleted_post'))
        <div class="alert alert-danger">{{session('deleted_post')}}</div>

    @endif

    <table class="table">
        <tr>
            <th>Id</th>
            <th>Owner</th>
            <th>Photo</th>
            <th>Category</th>
            <th>Post Title</th>
            <th>Post Excerpt</th>
        </tr>

        @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->user?$post->user->name:'Anonymous'}} </td>
                <td><img height="50" src="{{$post->photo?$post->photo->file:'/images/dp.jpg'}}" alt=""></td>
                <td>{{$post->category?$post->category->name:'Uncategorized'}}</td>
                <td><a href="{{route('admin.post.edit',$post->id)}}">{{$post->title}}</a></td>
                <td>{!! str_limit($post->body,100,' ...') !!}</td>
            </tr>
        @endforeach
    </table>
@stop