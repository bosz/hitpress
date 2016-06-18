@extends('layouts.blog-home')

@section('blog-post')
    @foreach($posts as $post)
        {{--<!-- First Blog Post -->--}}
        <h2>
        <a href="#">{{$post->title}}</a>
        </h2>
        <p class="lead">
        by <a href="index.php">{{$post->user->name}}</a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> {{$post->created_at->diffForHumans()}}</p>
        <hr>
        <img class="img-responsive" src="{{$post->photo?$post->photo->file:'http://placehold.it/900x300'}}" alt="">
        <hr>
        <p>{!! str_limit($post->body,600,'...') !!}</p>
        <a class="btn btn-primary" href="{{route('home.post',$post->id)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>
    @endforeach
@stop