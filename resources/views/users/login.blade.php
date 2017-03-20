@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" role="main">


                {!! Form::open(['url'=>'/user/login']) !!}
                        <!---  Field --->
                <div class="form-group">
                    {!! Form::label('email', '邮箱帐号:') !!}
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>

                <!---  Field --->
                <div class="form-group">
                    {!! Form::label('密码', '密码:') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}


                @if($errors->any())
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                        @endforeach
                    </ul>

                @endif
                    @if(Session::has('user_login_failed'))
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-danger"> {{Session::get('user_login_failed')}}</li>

                        </ul>
                    @endif
                {!! Form::submit('立即登录',['class'=>'btn btn-primary form-control']) !!}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@stop