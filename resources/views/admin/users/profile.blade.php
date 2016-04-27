@extends('admin.right')

@section('htmlheader_title')
    账号详情
@endsection
@section('otherheader')
    <link rel="stylesheet" type="text/css" href="{{asset('/static/js/jquery_easyui/themes/gray/easyui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/static/js/jquery_easyui/themes/icon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/static/js/jquery_easyui/themes/color.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/static/admin/account/css/storeAccount.css')}}">

    <script type="text/javascript" src="{{asset('/static/js/jquery_easyui/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/static/js/jquery_easyui/jquery.easyui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/static/js/jquery_easyui/locale/easyui-lang-zh_CN.js')}}"></script>
    <script type="text/javascript" src="{{asset('/static/admin/account/js/storeAccount.js')}}"></script>
@endsection

@section('content')


    <div class="editorMain box box-primary ">
        <div class="box-header">
            <h3 class="box-title">账户信息</h3>
        </div>
        <!-- /.box-header -->


        <div class="box-body">
            <form id="accountForm" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group with-border">
                    <div class="checkbox">
                        <label>角&nbsp;&nbsp;色：</label><label>{!! implode(", ", array_column($user['roles'],"display_name")) !!}</label>
                    </div>
                </div>
                <div class="form-group with-border">
                    <div class="checkbox">
                        <label>用户名：</label><label>{!! $user['username'] !!}</label>
                    </div>
                </div>
                <div class="form-group with-border">
                    <div class="checkbox">
                        <label>手机：</label> <label>{!! $user['mobile'] !!}</label>
                    </div>
                </div>
                <div class="form-group with-border">
                    <div class="checkbox">
                        <label>昵&nbsp;&nbsp;称：</label><label><span name="nick">{!! $user['nick'] !!}</span></label>
                    </div>
                </div>
                <div class="form-group with-border">
                    <div class="checkbox">
                        <label>邮&nbsp;&nbsp;箱：</label><label><span name="email">{!! $user['email'] !!}</span></label>
                    </div>
                </div>

                <div class="form-group with-border">
                    <div class="checkbox">
                        <label>QQ：</label><label><span name="qq">{!! $user['qq'] !!}</span></label>
                    </div>
                </div>

                <div class="form-group with-border">
                    <div class="checkbox">
                        <label>微&nbsp;&nbsp;信：</label><label><span name="wechat">{!! $user['wechat'] !!}</span></label>
                    </div>
                </div>

                <div class="box-footer">
                    <input class="btn btn-primary" type="button" value="更改" id="accountBtn" onclick="editUser()"/>
                    <a href="{{url('admin/change/password')}}"><input class="btn btn-primary" type="button" value="修改密码" id="accountBtn"/></a>
                </div>
            </form>

        </div>
    </div>

@stop


@section('otherfooter')
    <script>

        function editUser() {
            var save = "保存";
            if ($('#accountBtn').val() === save) {
                $('#accountForm').form('submit', {
                    url: '/admin/user/action/profile',
                    onSubmit: function (param) {
                        //var r=$(this).form("validate");
                        //if(!r){$.messager.progress('close');return false;}
                        //if(this.sing_dir.value==''){$.messager.alert('提示','请上传歌曲！',"info");$.messager.progress('close');return false;}
                        return true;
                    },
                    success: function (data) {
                        var data = eval('(' + data + ')');  // change the JSON string to javascript object
                        $.messager.alert('提示', data.message);
                    }
                });
            }
        }
    </script>

@stop
