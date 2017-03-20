@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" role="main">


                {!! Form::open(['url'=>'/changepassword']) !!}
                        <!---  Field --->


                <!---  Field --->
                <div class="form-group">
                    {!! Form::label('旧密码', '旧密码:') !!}
                    {!! Form::password('oldpassword', ['class' => 'form-control']) !!}
                    @if( $errors->has('oldpassword') )

                        <p class="bg-danger"> {{$errors->first()}}</p>
                        @endif
                    <!---  Field --->
                    <div class="form-group">
                        {!! Form::label('新密码', '新密码:') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                        @if( $errors->has('password') )

                            <p class="bg-danger"> {{$errors->first()}}</p>
                            @endif
                    <!---  Field --->
                    <div class="form-group">
                        {!! Form::label('重复密码', '重复密码:') !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    </div>
                            @if( $errors->has('password_confirmation') )

                                <p class="bg-danger"> {{$errors->first()}}</p>
                            @endif

                    {!! Form::submit('立即修改',['class'=>'btn btn-primary form-control']) !!}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
@stop