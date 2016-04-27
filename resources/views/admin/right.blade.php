<!DOCTYPE html>
<html>
<head>
    <meta property="qc:admins" content="24531766656451452116375" />
    <meta charset="UTF-8"  name="csrf-token" content="{{ csrf_token() }}" property="qc:admins" content="24531766656451452116375" />
    {{--<meta charset="UTF-8"  name="csrf-token" content="{{ csrf_token() }}">--}}

    <title>@yield('htmlheader_title')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset('/static/admin/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- FontAwesome 4.3.0-->
    <link  href="{{ asset('/static/admin/font-awesome-4.3.0/css/font-awesome.min.css')}}"  rel="stylesheet" type="text/css" />
    
    <!-- Ionicons 2.0.0-->
    <link href="{{ asset('/static/admin/bootstrap/css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Theme style -->
    <link href="{{ asset('/static/admin/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="{{ asset('/static/admin/dist/css/skins/_all-skins.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{ asset('/static/admin/plugins/iCheck/flat/blue.css')}}" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="{{ asset('/static/admin/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="{{ asset('/static/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="{{ asset('/static/admin/plugins/datepicker/datepicker3.css')}}" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="{{ asset('/static/admin/plugins/daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="{{ asset('/static/admin/plugins/datepicker/datepicker3.css')}}" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="{{ asset('/static/admin/plugins/daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="{{ asset('/static/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{asset('/static/js/jquery.min.js')}}"></script>
    <script src="{{ asset('/static/admin/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('/static/admin/plugins/daterangepicker/moment.js')}}"></script>
    <script src="{{asset('/static/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script>
        var _token="{!! csrf_token() !!}";
    </script>
    @yield('otherheader')
    <style>
        .table tbody tr{cursor: pointer;}
        .table tbody tr:hover{background: #ecf0f5;}
        .table_tr_select{background: #ecf0f5;}
    </style>
</head>
<body class="skin-blue sidebar-collapse" style="background-color: #ecf0f5;">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('htmlheader_title')
                <small>@yield('htmlheader_desc')</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{asset('/admin/profile')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">@yield('htmlheader_title')</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section><!-- /.content -->
    </div>
</body>
<script>
    $('.table tbody tr').bind('click',function(){
        $(".table tbody tr").each(function () {
            $(this).removeClass('table_tr_select');
        })
        $(this).addClass('table_tr_select');
    });
    $(function(){
        $('.datepicker').datepicker({format:'yyyy-mm-dd'});
        $('.datetimepicker').daterangepicker({
            timePickerIncrement: 30,
            format: 'YYYY-MM-DD HH:mm:ss',
            singleDatePicker: true,
            timePicker: true,
            timePicker12Hour: false,
            timePickerSeconds: true,
        });
        $('.ajax-save-form').submit(function () {
            $('input[type="submit"]').attr('disabled','disabled');
            var _this = $(this);
            $.ajax({
                url: _this.attr('action'),
                type: _this.attr('method'),
                data: _this.serialize(),
                dataType: 'json',
                success: function (data) {
                    if(data.status == 'error'){
                        $('.content').find('.alert-error').removeClass('hide').addClass('show').find('span').html(data.message);
                        $('.content').find('.alert-success').removeClass('show').addClass('hide');
                    }else{
                        $('.content').find('.alert-error').removeClass('show').addClass('hide');
                        $('.content').find('.alert-success').removeClass('hide').addClass('show');
                        if(data.result.url != undefined){
                            setTimeout(function(){
                                window.location.href = data.result.url;
                            },1000);
                        }
                    }
                    $('input[type="submit"]').removeAttr('disabled');
                }
            });
            return false;
        });
    });
</script>
@yield('otherfooter')
</html>