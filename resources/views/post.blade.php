@extends('layouts.blog-post')

@section('content')

        <!-- Blog Post -->

<!-- Title -->
<h1>{{$post->title}}</h1>

<!-- Author -->
<p class="lead">
    by <a href="#">{{$post->user->name}}</a>
</p>

<hr>

<!-- Date/Time -->
<p><span class="glyphicon glyphicon-time"></span> Posted {{$post->updated_at->diffForHumans()}}</p>

<hr>

<!-- Preview Image -->
<img class="img-responsive" src="{{$post->photo?$post->photo->file:'Null'}}" alt="">

<hr>

<!-- Post Content -->
<p>{!! $post->body !!}</p>
<hr>

<!-- Blog Comments -->

<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment:</h4>
    {!! Form::open(['action'=>'PostsCommentsController@store']) !!}

            <input type="hidden" name="post_id" value="{{$post->id}}">

            <div class="form-group">
                {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Your Name']) !!}
            </div>



        <div class="form-group">
            {!! Form::textarea('body',null,['class'=>'form-control','placeholder'=>'Comment','rows'=>3]) !!}
        </div>






        {!! Form::submit('Comment',['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}


</div>

<hr>

<!-- Posted Comments -->

<!-- Comment -->
@if(count($comments) > 0)
@foreach($comments as $comment )
<div class="media">
    <a class="pull-left" href="#">
        <img class="media-object" src="http://placehold.it/64x64" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading"> {{ucfirst($comment->name)}}
            <small>{{$comment->created_at->diffForHumans()}}</small>
        </h4>
            {!! $comment->body !!}

                    <!-- Reply  -->
        <div class="media">


            {{-- Reply Display--}}

            @foreach($comment->replies as $reply)

            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{$reply->author}}
                    <small>August 25, 2014 at 9:30 PM</small>
                </h4>
                    {{$reply->body}}
            </div>
                @endforeach

            <button class="btn btn-primary btn-sm btn-reply pull-right">Reply toggle</button>
            <div style="display: none" class="reply-form">
                <h4>Reply:</h4>
                {{--Reply form--}}
                {!! Form::open(['action'=>'CommentsRepliesController@store']) !!}

                <input type="hidden" name="comment_id" value="{{$comment->id}}">

                <div class="form-group">
                    {!! Form::text('author',null,['class'=>'form-control','placeholder'=>'Your Name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::textarea('body',null,['class'=>'form-control','placeholder'=>'Reply','rows'=>3]) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Reply',['class'=>'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>

        </div>
        <!-- End Reply -->
    </div>
</div>
@endforeach

@endif

@stop

@section('script')

    <script>
        $('.btn-reply').click(function(){
//           $('.reply-form').toggle('slow');
            $(this).next().toggle('slow');
        });
    </script>

@stop
