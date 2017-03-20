@extends('app')
@section('content')
    <div class="container">
          <div class="row">
            <div class="col-md-6 col-md-offset-3" role="main">


                   {!! Form::open(['url'=>'/user/register']) !!}
                <!---  Field --->
                <div class="form-group">
                    {!! Form::label('用户名', '用户名:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <!---  Field --->
                <div class="form-group">
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>
                <!---  Field --->
                <div class="form-group">
                    {!! Form::label('密码', '密码:') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
             <!---  Field --->
             <div class="form-group">
                 {!! Form::label('重复密码', '重复密码:') !!}
                 {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}

             </div>

                @if($errors->any())
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                {!! Form::submit('立即注册',['class'=>'btn btn-primary form-control']) !!}
                {!! Form::close() !!}

            </div>
          </div>
    </div>
    @stop