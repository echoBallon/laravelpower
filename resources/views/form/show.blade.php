@extends('app')
@section('content')
    <div class="container">

        <!-- Main component for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="media">
            <div class="media-left">
            <a href="#">
              <img class="media-object img-circle" alt="64x64" src="{{$discussion->user->avatar}}" style="width: 64px; height: 64px;">
            </a>
            </div>
            <div class="media-body">
            <h4 class="media-heading">{{$discussion->title}}</h4>
    {{$discussion->user->name}}
    </div>
    </div>
       @if(Auth::check() && Auth::user()->id ==$discussion->user_id)
        <a class="btn btn-lg btn-primary pull-right" href="/discussions/{{$discussion->id}}/edit" role="button">修改帖子</a></h2>
           @endif
</div>
</div>
<div class="container" id="post">
<div class="row">
    <div class="col-md-9" role="main" >
       {!!$html!!}
    </div>

</div>
    <hr>
    @foreach($discussion->comments as $comment)
        <div class="media">
            <div class="media-left">
                <a href="#">
                    <img class="media-object img-circle" alt="64x64" src="{{$comment->user->avatar}}" style="width: 64px; height: 64px;">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">{{$comment->user->name}}</h4>
                {{$comment->body}}
            </div>
        </div>

    @endforeach
    {{--<div class="media" v-for="comment in comments">--}}
        {{--<div class="media-left" >--}}
            {{--<a href="#">--}}
                {{--<img class="media-object img-circle" alt="64x64" src="comment.avatar" style="width: 64px; height: 64px;">--}}
            {{--</a>--}}
        {{--</div>--}}
        {{--<div class="media-body">--}}
            {{--<h4 class="media-heading">@{{comment.name}}</h4>--}}
            {{--@{{comment.body}}--}}
        {{--</div>--}}
    {{--</div>--}}
    <hr>
    @if(\Illuminate\Support\Facades\Auth::check())
       {!! Form::open(['url'=>'/comment','v-on:submit'=>'onSubmitform']) !!}
             {!! Form::hidden('discussion_id',$discussion->id) !!}
           <!---  Field --->
           <div class="form-group">
               {!! Form::textarea('body', null, ['class' => 'form-control','v-model'=>'newComment.body']) !!}
           </div>
    {!! Form::submit('发表评论',['class'=>'btn btn-success pull-right']) !!}
          {!! Form::close() !!}
      @else
        <a href="/user/login" class="btn btn-block">登录参与评论</a>
        @endif
</div>

    <script>
   new Vue({

       {{--el:'#post',--}}
       {{--data:{--}}

          {{--comments:[],--}}
           {{--newCommnet:{--}}
               {{--name:'{{\Illuminate\Support\Facades\Auth::user()->name}}',--}}
               {{--avatar:'{{\Illuminate\Support\Facades\Auth::user()->avatar}}',--}}
               {{--body:''--}}
           {{--},--}}
           {{--newPost:{--}}
               {{--discussion_id:'{{$discussion->id}}',--}}
               {{--user_id:'{{\Illuminate\Support\Facades\Auth::user()->id}}',--}}
               {{--body:''--}}
           {{--},--}}
       {{--},--}}
       {{--methods:{--}}
           {{--onSubmitform: function (e) {--}}
               {{--e.preventDefault();--}}
               {{--var comment = this.newCommnet;--}}
               {{--var post = this.newPost;--}}
               {{--post.body = comment.body;--}}
               {{--this.$http.post('/comment',post, function () {--}}
                   {{--this.comments.push(comment);--}}
               {{--});--}}
               {{--this.newCommnet ={--}}
                   {{--name:'{{\Illuminate\Support\Facades\Auth::user()->name}}',--}}
                   {{--avatar:'{{\Illuminate\Support\Facades\Auth::user()->avatar}}',--}}
                   {{--body:''--}}
               {{--};--}}

           {{--}--}}
       {{--}--}}
   {{--})--}}

    </script>
@stop