@extends('auth.auth')

@section('htmlheader_title')
    推图家后台
@endsection

@section('content')
    <script>

    </script>
    <body class="login-page" style="display:none;">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/admin/login') }}"><b>堆图家后台</b></a>
        </div>
        <!-- /.login-logo -->

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>抱歉!</strong> 您的账号密码好像有点小问题！<br><br>
                <!--
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                        </ul>
                        -->
            </div>
        @endif

        <div class="login-box-body">
            <p class="login-box-msg">请输入您的账号和密码</p>

            <form action="{{ url('/auth/login') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                {{--<div class="form-group has-feedback">--}}
                {{--<input type="text" class="form-control" placeholder="text" name="email"/>--}}
                {{--<span class="glyphicon glyphicon-envelope form-control-feedback"></span>--}}
                {{--</div>--}}

                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="用户名/手机号/邮箱 " name="account"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="密码" name="password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">

                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                <div class="loginQQ">使用QQ帐号登录:<span id="qq_login_btn"><a href="{{url('qq/login')}}"><img src="{{ asset('/static/admin/img/qqlogin.png')}}"></a></span></div>

                <div class="loginQQ">使用微信帐号登录:<span id="weichat_login_btn"><a href="{{url('wechat/login')}}"><img src="{{ asset('/static/admin/img/weichat.png')}}"></a></span></div>
                </div>
            </form>

            <!-- /.social-auth-links -->
            <!--
            <a href="{{ url('/password/email') }}">I forgot my password</a><br>
            <a href="{{ url('/auth/register') }}" class="text-center">Register a new membership</a>
            -->

        </div>
        <!-- /.login-box-body -->

    </div>
    <!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('/static/admin/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset('/static/admin/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <!-- iCheck
    <script src="{{ asset('//static/admin/plugins/iCheck/icheck.min.js')}}" type="text/javascript"></script> -->
    <script>
        $(function () {
            if (self.frameElement && self.frameElement.tagName == "IFRAME") {
                parent.location.reload();
            }
            $('body').fadeIn();
        });
    </script>
    </body>


@endsection
