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


    <div class="editorMain box box-primary ">
        <!-- /.box-header -->


        <div class="box-body">
            <form id="accountForm" method="POST" action="/admin/change/password">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group with-border">
                    <label class="col-md-4 control-label">原密码</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="form-group with-border">
                    <label class="col-md-4 control-label">新密码</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" name="new_password">
                    </div>
                </div>

                <div class="form-group with-border">
                    <label class="col-md-4 control-label">确认密码</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>

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
                    var r=$(this).form("validate");
                    if(this.new_password.value!=this.password_confirmation.value){$.messager.alert('提示','请确认新密码！',"info");return false;}
                    return true;
                },
                success: function (data) {
                    //console.log(data);
                    var data = eval('(' + data + ')');  // change the JSON string to javascript object
                    $.messager.alert('提示', data.message);
                    if (200==data.code){
                        location.href = '/admin/profile';
                    }

                }
            });

        }
    </script>

@stop
