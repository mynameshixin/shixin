@extends('admin.right')

@section('htmlheader_title')
    用户详情
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

@section('otherfooter')

    <script>
        var tree = <?php echo json_encode($tree);?>;
        var url = "<?php echo $url;?>";
        var isEdit = true;
        function editUser() {
            var save = "保存";
            if ($('#accountBtn').val() === save) {
                $('#accountForm').form('submit', {
                    url: '/admin/user/action/edit?update=' + $('#user_id').val(),
                    onSubmit: function (param) {
                        //var r=$(this).form("validate");
                        //if(!r){$.messager.progress('close');return false;}
                        //if(this.sing_dir.value==''){$.messager.alert('提示','请上传歌曲！',"info");$.messager.progress('close');return false;}
                        return true;
                    },
                    success: function (data) {
                        //$.messager.progress('close');
                        var data = eval('(' + data + ')');  // change the JSON string to javascript object
                        $.messager.alert('提示', data.message);
                    }


                });
            }


        }
        function editRole() {
            var save = "保存";
            if ($('#adminBtn').val() === save) {
                $('#adminForm').form('submit', {
                    url: '/admin/user/action/role',
                    onSubmit: function (param) {
                        var r=$(this).form("validate");
                        if(typeof this.role_id == 'undefined' || this.role_id.value==''){$.messager.alert('提示','请选中角色！',"info");return false;}
                        return true;
                    },
                    success: function (data) {
                        var data = eval('(' + data + ')');
                        $.messager.alert('提示', data.message);
                    }


                });
            }


        }
    </script>

@section('content')

    <div class="editorMain box box-primary ">

        <div class="box-header with-border">
            <div class="checkbox">
                <b>账户情况</b><input class="menu-btn" type="button" value="更改" id="accountBtn" onclick="editUser()"/>
            </div>
        </div>

        <div class="box-body">


            <form id="accountForm" method="POST">
                <div class="form-group with-border">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="user_id" ,name="user_id" value="{{ $user['id'] }}">
                    <input type="hidden" id="id" ,name="id" value="{{ $user['id'] }}">
                    <div class="checkbox">
                        用户名：{!! $user['username'] !!}
                    </div>
                </div>
                <div class="form-group with-border">
                    <div class="checkbox">
                        手机： <span name="mobile">{!! $user['mobile'] !!}</span>
                    </div>
                </div>
                <div class="form-group with-border">
                    <div class="checkbox">
                        昵称：<span name="nick">{!! $user['nick'] !!}</span>
                    </div>
                </div>
                <div class="form-group with-border">
                    <div class="checkbox">
                        邮箱 ：<span name="email">{!! $user['email'] !!}</span>
                    </div>
                </div>
                <div class="form-group with-border">
                    <div class="checkbox">
                        qq ：<span name="qq">{!! $user['qq'] !!}</span>
                    </div>
                </div>
                <div class="form-group with-border">
                    <div class="checkbox">
                        微信号 ：<span name="wechat">{!! $user['wechat'] !!}</span>
                    </div>
                </div>

                <div class="form-group with-border">
                    <div class="checkbox">
                        用户状态 ：@if(isset($status) && !empty($status))
                            @foreach ($status as $k=>$v)

                                <label> <input name="status" type="radio" disabled @if($user['status'] == $k) checked
                                               @endif  value="{{$k}}"/> {{$v}}</label>

                            @endforeach
                        @endif
                    </div>
                </div>

            </form>

            <div class="form-group with-border">
                <div class="checkbox">
                    <b>角色管理</b><input class="menu-btn" type="button" value="更改" id="adminBtn" onclick="editRole()"/>
                </div>
            </div>
            <form id="adminForm" method="POST">
                <input type="hidden" name="id" value="{{ $user['id'] }}">

                <div class="form-group with-border">
                    <div class="checkbox">
                        @if(isset($roles) && !empty($roles))
                            @foreach ($roles as $key=>$val)
                                    <label> <input name="role_id" type="radio" disabled @if(isset($role_ids) && in_array($key,$role_ids)) checked @endif  value="{{$key}}"/> {{$val}}</label>
                            @endforeach
                        @endif

                    </div>
                </div>

            </form>


            {{--<div id="permission"></div>--}}

        </div>
    </div>



@stop