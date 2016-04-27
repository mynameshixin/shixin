<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta property="qc:admins" content="24531766656451452116375" />
    <title>@yield('htmlheader_title')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{asset('/static/admin/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <!-- Theme style -->
    <link href="{{asset('/static/admin/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- iCheck -->
    <link href="{{asset('/static/admin/plugins/iCheck/square/blue.css')}}" rel="stylesheet" type="text/css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('/static/admin/bootstrap/js/html5shiv.min.js')}}"></script>
    <script src="{{ asset('/static/admin/bootstrap/js/respond.min.js')}}"></script>
    <![endif]-->
</head>

@yield('content')
</html>