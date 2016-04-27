@extends('admin.right')

@section('htmlheader_title')
    修改密码
@endsection
@section('otherheader')
    <link rel="stylesheet" type="text/css" href="{{asset('/static/js/jquery_easyui/themes/gray/easyui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/static/js/jquery_easyui/themes/icon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/static/js/jquery_easyui/themes/color.css')}}">
    <!--
    <link rel="stylesheet" type="text/css" href="{{asset('/static/admin/account/css/storeAccount.css')}}">
    -->

    <script type="text/javascript" src="{{asset('/static/js/jquery_easyui/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/static/js/jquery_easyui/jquery.easyui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/static/js/jquery_easyui/locale/easyui-lang-zh_CN.js')}}"></script>
@endsection

@section('content')





    <div class="col-md-6">
        <!-- /.box-header -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">请谨慎操作此步骤！</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" id="accountForm" action="/admin/change/password" accept-charset="UTF-8" role="form">
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputPassword1">原密码</label>


                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                               placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">新密码</label>


                        <input type="password" name="new_password" class="form-control" id="exampleInputPassword1"
                               placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">确认密码</label>


                        <input type="password" name="password_confirmation" class="form-control"
                               id="exampleInputPassword1" placeholder="Password">
                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <input class="btn btn-primary" type="button" value="修改" id="accountBtn" onclick="editPassword()"/>
                </div>
            </form>
        </div>

    </div>



@stop


@section('otherfooter')
    <script>
        function editPassword() {

            $('#accountForm').form('submit', {
                url: '/admin/change/password',
                onSubmit: function (param) {
                    var r = $(this).form("validate");
                    if (this.new_password.value != this.password_confirmation.value) {
                        $.messager.alert('提示', '请确认新密码！', "info");
                        return false;
                    }
                    return true;
                },
                success: function (data) {
                    //console.log(data);
                    var data = eval('(' + data + ')');  // change the JSON string to javascript object
                    $.messager.alert('提示', data.message);
                    if (200 == data.code) {
                        location.href = '/admin/profile';
                    }

                }
            });

        }
    </script>

@stop
