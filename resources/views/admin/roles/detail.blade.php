@extends('admin.right')

@section('htmlheader_title')
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
        var tree= <?php echo json_encode($tree);?>;
        var url= "<?php echo $url;?>";
        function editUser() {
            var save = "保存";
            if ($('#accountBtn').val() === save) {
                $('#accountForm').form('submit', {
                    url: '/admin/role/action/edit?update=' + $('#role_id').val(),
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


    </script>

@section('content')
    <section class="content">

        <div class="editorMain">

            <div class="box-header with-border">
                <div class="checkbox">
                    <b>角色详情</b><input type="button" value="更改" id="accountBtn" onclick="editUser()"/>
                </div>
            </div>
            <form id="accountForm" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" id="id" name="id" value="{{ $role['id'] }}" />
                <input type="hidden" id="role_id" name="role_id" value="{{ $role['id'] }}" />
                <div class="box-header with-border">
                    <div class="checkbox">
                        角色名称：<span name="name">{{$role['name']}} </span>
                    </div>
                </div>
                <div class="box-header with-border">
                    <div class="checkbox">
                        角色描述权限：<span name="display_name">{!! $role['display_name'] !!} </span>
                    </div>
                </div>
                <div class="box-header with-border">
                    <div class="checkbox">
                        链接描述：<span name="description">{!! $role['description'] !!}</span>
                    </div>
                </div>
            </form>
        </div>
        <div id="permission"></div>

    </section>

@stop