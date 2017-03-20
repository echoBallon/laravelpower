@extends('app')
@section('content')
    @include('editor::head')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" role="main">
                {!! Form::model($discussion,['method'=>'PATCH','url'=>'discussions/'.$discussion->id]) !!}

                        <!---  Field --->
                <div class="form-group">
                    {!! Form::label('title', 'title:') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
                <!---  Field --->
                <div class="form-group">
                    <div class="editor">
                        {!! Form::textarea('body', null, ['class' => 'form-control','id'=>'myEditor']) !!}

                    </div>
                </div>
                {!! Form::submit('发表帖子',['class'=>'btn btn-primary form-control pull-right']) !!}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@stop