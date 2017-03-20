<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laravel App</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/font-awesome.css">
    <link rel="stylesheet" href="/css/ueditor.min.css">
    <script src="/js/jquery-3.2.0.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.form.js"></script>
    <script src="/js/jquery.Jcrop.min.js"></script>
    <script src="/js/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/vue.resource/1.2.1/vue-resource.min.js"></script>
    <meta id="token" name="token" value="{{ csrf_token() }}">
</head>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Laravel App</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">首页</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">

                @if(Auth::check())
                    <li class="dropdown" id="accountmenu">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{\Illuminate\Support\Facades\Auth::user()->name}}<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/user/avatar"> <i class="fa fa-user"></i> 更换头像</a></li>
                            <li><a href="/user/changepassword"> <i class="fa fa-cog"></i> 更换密码</a></li>
                            <li><a href="#"> <i class="fa fa-heart"></i> 特别感谢</a></li>
                            <li role="separator" class="divider"></li>
                            <li> <a href="/logout">  <i class="fa fa-sign-out"></i> 退出登录</a></li>
                        </ul>
                    </li>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.dropdown-toggle').dropdown();
                        });
                    </script>
                <li><img src="{{\Illuminate\Support\Facades\Auth::user()->avatar}}" class="img-circle" width="50px" alt=""></li>

               @else
                <li><a href="/user/login">登录</a></li>
                <li><a href="/user/register">注册</a></li>
                    @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<body>

  @yield('content')
  <blockquote class="text-center">

      <footer>Developed By Echo Powered By Laravel
          <br> <cite title="Source Title">
              @2017
          </cite></footer>
  </blockquote>
</body>
</html>