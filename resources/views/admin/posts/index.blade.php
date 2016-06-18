@extends('layouts.admin')

@section('content')
    <h2>Posts</h2>

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
                <td>{{str_limit($post->body,100,' ...')}}</td>
            </tr>
        @endforeach
    </table>
@stop