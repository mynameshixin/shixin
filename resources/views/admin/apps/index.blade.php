@extends('admin.right')

@section('htmlheader_title')
九宫格
@endsection
@section('otherheader')
<link rel="stylesheet" type="text/css" href="{{asset('/static/js/jquery_easyui/themes/gray/easyui.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/static/js/jquery_easyui/themes/icon.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/static/js/jquery_easyui/themes/color.css')}}">
<script type="text/javascript" src="{{asset('/static/js/jquery_easyui/jquery.easyui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/static/js/jquery_easyui/locale/easyui-lang-zh_CN.js')}}"></script>
@endsection

@section('content')
    <div class="editorMain box box-primary " style="padding: 10px;">
        {!! $filter !!}
        <br/>
        <input class="btn btn-primary" type="button" value="新增" onclick="openNew()">
        <input class="btn btn-primary" type="button" value="下线" onclick="set_up_down(0)">
        <input class="btn btn-primary" type="button" value="上线" onclick="set_up_down(1)">
        <input class="btn btn-primary" type="button" value="删除" onclick="del()">
        {!! $grid !!}
    </div>
@endsection

@section('otherfooter')
<script>
    $('.table tbody tr').bind('click',function(){
        if($(this).find('[name="appIds"]').is(":checked")){
            $(this).find('[name="appIds"]').removeAttr('checked');
        }else{
            $(this).find('[name="appIds"]').prop('checked',"true");
        }
    });
    var allStore={!! json_encode($allStore) !!};
    var isuse={!! json_encode($isuse) !!};
    function openNew(){//增加的弹窗
        var win_id='win_add_form_app-div';
        if($('#'+win_id).length<1){
            $('body').append('<div id="'+win_id+'"></div>');
        }
        var form=$('<form id="form_add_app" method="POST" enctype="multipart/form-data" ></form>');
        var table=$("<table style='width:90%;margin:0 auto;margin-top:10px;cellspacing:5px;'></table>");
        table.append('<tr><td style="width:70px;">名称:<td><input type="hidden" name="_token" value="'+_token+'"><input class="easyui-textbox" name="name" style="width:150px;" data-options="required:true,missingMessage:\'亲！名称？\'">');
        table.append('<tr><td>ICON:<td><input class="easyui-filebox" name="image[]"  data-options="prompt:\'Choose a pic...\'" style="width:150px;">');
        table.append('<tr><td>链接:<td><input class="easyui-textbox" name="link" style="width:150px;" data-options="required:true,missingMessage:\'亲！链接？\'">');
        table.append('<tr><td>样式:<td><input class="easyui-textbox" name="style" style="width:150px;height:80px;" data-options="multiline:true,required:true,missingMessage:\'亲！样式？\'">');

        var select_status='<select class="easyui-combobox" name="status">';
        for(var i in isuse){
            select_status+='<option value="'+i+'">'+isuse[i]+'</option>';
        }
        select_status+='</select>'
        table.append('<tr><td>状态:<td>'+select_status);
        var select_store='<select class="easyui-combobox" name="allStore" id="allStore">';
        for(var i in allStore){
            select_store+='<option value="'+i+'">'+allStore[i]+'</option>';
        }
        select_store+='</select>';
        table.append('<tr><td>门店:<td>'+select_store+' <input type="hidden" name="stores" id="stores" data-options="required:true,missingMessage:\'亲！请增加门店！\'" /><br />排序值:<input class="easyui-numberspinner" value="100" name="sorts" id="sorts" style="width:50px;" data-options="required:true,missingMessage:\'亲！排序值？\'"><a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:\'icon-add\'" style="width:100px;" id="store_add">增加</a>');
        table.append('<tr><td><td id="td_stores"><ul style="list-style: none;margin-left:-40px;"></ul>');
        //table.append('<tr><td>');


        form.append(table);

        var contents=[form];
        $('#'+win_id).dialog({
            title:'新增',
            width:500,
            height:400,
            modal:true,
            content:contents,
            minimizable:false,
            maximizable:false,
            collapsible:false,
            buttons: [{
                text:'提交',
                iconCls:'icon-save',
                handler:function(){
                    $.messager.progress();
                    $('#form_add_app').form('submit', {
                        url:'/admin/app/action/edit?insert=1',
                        onSubmit: function(param){
                            var r=$(this).form("validate");
                            if(!r){$.messager.progress('close');return false;}
                            if(this.stores.value==""){$.messager.alert('提示','请增加门店！',"info");$.messager.progress('close');return false;}
                            return true;
                        },
                        success: function(data){
                            $.messager.progress('close');
                            var data = eval('(' + data + ')');  // change the JSON string to javascript object
                            if(data.data){
                                $.messager.alert('提示',"添加成功");
                                window.location.reload();
                                return;
                            }
                            $.messager.alert('提示',data.message);
                            return;

                        }
                    });
                }
            },{
                text:'关闭',
                handler:function(){
                    $('#'+win_id).dialog('close');return;
                }
            }]
        });
        $('#form_add_app').form('load',{
            status:1
        });
        $('#form_add_app #store_add').bind('click',function(){
            var storeValue=$('#form_add_app #allStore').combobox('getValue');
            var storeName=$('#form_add_app #allStore').combobox('getText');
            var stores=$('#form_add_app #stores').val();
            var stores_sort=$('#form_add_app #sorts').val();
            if(stores_sort==undefined) {$.messager.alert('提示',"请填写门店排序！");return;}
            var stores_arr=stores.split(",");
            for(var i=0;i<stores_arr.length;i++){
                if(stores_arr[i]==storeValue){
                    $.messager.alert('提示',"已经添加过啦！！");return;
                }
            }
            var show='<li style="float:left;display:block;margin-left:10px;" id="store_id_'+storeValue+'">'+storeName+'->'+stores_sort+' <input type="hidden" name="sort['+storeValue+']" value="'+stores_sort+'"><a href="javascript:void(0)" class="easyui-linkbutton" style="width:10px;height:10px;color:red;" value="'+storeValue+'">X</a></li>';
            $('#form_add_app #td_stores ul').append(show);

            if(stores!=""){stores_arr.push(storeValue);
                $('#form_add_app #stores').val(stores_arr);
            }else{
                $('#form_add_app #stores').val(storeValue);
            }
            $('#form_add_app #td_stores ul li a').unbind('click').bind('click',function(){
                var delStoreId=$(this).attr('value');
                var stores=$('#form_add_app #stores').val();
                var stores_arr=stores.split(",");
                var newStore=[];
                for(var i=0;i<stores_arr.length;i++){
                    if(stores_arr[i]!=delStoreId){
                        newStore.push(stores_arr[i]);
                    }
                }
                $('#form_add_app #td_stores ul #store_id_'+delStoreId).remove();
                $('#form_add_app #stores').val(newStore);
                return;

            });
        });
    }

    function set_up_down(setValue){
        var chk_value =[];
        $('input[name="appIds"]:checked').each(function(){
            chk_value.push($(this).val());
        });

        if(chk_value.length<1){$.messager.alert('提示',"请选择复选框！！");return;}
        $.messager.confirm('确认框', '确认将选择的内容设置为'+isuse[setValue]+'?', function(r){
            if (r){
                $.messager.progress();
                $.ajax({
                    type: "POST",
                    url: "/admin/app/action/setstatus",
                    data: {status:setValue,appIds:chk_value,_token:_token},
                    dataType: "json",
                    success: function(data){
                        $.messager.progress('close');
                        if(data.data){
                            $.messager.alert('提示',"修改成功！");
                            window.location.reload();
                            return;

                        }
                        $.messager.alert('提示',"修改失败！");return;
                    },
                    error:function(e){
                        $.messager.progress('close');
                        $.messager.alert('提示',"系统错误！",'error');
                    }
                });
            }
        });

    }
    function del(setValue){
        var chk_value =[];
        $('input[name="appIds"]:checked').each(function(){
            chk_value.push($(this).val());
        });
        if(chk_value.length<1){$.messager.alert('提示',"请选择复选框！！");return;}
        $.messager.confirm('确认框', '确认删除所选应用?', function(r){
            if (r){
                $.messager.progress();
                $.ajax({
                    type: "POST",
                    url: "/admin/app/action/edit?delete=1",
                    data: {appIds:chk_value,_token:_token},
                    dataType: "json",
                    success: function(data){
                        $.messager.progress('close');
                        if(data.data){
                            $.messager.alert('提示',"删除成功！");
                            window.location.reload();
                            return;

                        }
                        $.messager.alert('提示',"删除失败！");return;
                    },
                    error:function(e){
                        $.messager.progress('close');
                        $.messager.alert('提示',"系统错误！",'error');
                    }
                });
            }
        });
    }
    function win_edit(id,edit){

        $.messager.progress();
        //return;
        $.ajax({
            type: "GET",
            url: "/admin/app/action/index",
            data: {id:id,_token:_token},
            dataType: "json",
            //async:false,
            success: function(data){
                $.messager.progress('close');
                var appInfo=data.data;
                if(appInfo.id!=undefined){
                    if(edit==1){
                        edit_win(appInfo);
                    }else{
                        show_win(appInfo);
                    }
                }
            },
            error:function(e){
                $.messager.progress('close');
                $.messager.alert('提示',"系统错误！",'error');
            }
        });

    }
    function edit_win(appInfo){

        var win_id='win_edit_form_app-div';
        if($('#'+win_id).length<1){
            $('body').append('<div id="'+win_id+'"></div>');
        }
        var form=$('<form id="form_edit_app" method="POST" enctype="multipart/form-data" ></form>');
        var table=$("<table style='width:90%;margin:0 auto;margin-top:10px;cellspacing:5px;'></table>");
        table.append('<tr><td style="width:70px;">名称:<td><input type="hidden" name="_token" value="'+_token+'"><input class="easyui-textbox" name="name" style="width:150px;" data-options="required:true,missingMessage:\'亲！名称？\'">');
        table.append('<tr><td>ICON:<td><input class="easyui-filebox" name="image"  data-options="prompt:\'Choose a pic...\'" style="width:150px;"><span id="span_img"></span>');
        table.append('<tr><td>链接:<td><input class="easyui-textbox" name="link" style="width:150px;" data-options="required:true,missingMessage:\'亲！链接？\'">');
        table.append('<tr><td>样式:<td><input class="easyui-textbox" name="style" style="width:150px;height:80px;" data-options="multiline:true,required:true,missingMessage:\'亲！样式？\'">');
        //table.append('<tr><td>排序值:<td><input class="easyui-numberspinner" name="sorts" id="sorts" style="width:50px;" data-options="required:true,missingMessage:\'亲！排序值？\'">');

        var select_status='<select class="easyui-combobox" name="status">';
        for(var i in isuse){
            select_status+='<option value="'+i+'">'+isuse[i]+'</option>';
        }
        select_status+='</select>'
        table.append('<tr><td>状态:<td>'+select_status);
        var select_store='<select class="easyui-combobox" name="allStore" id="allStore">';
        for(var i in allStore){
            select_store+='<option value="'+i+'">'+allStore[i]+'</option>';
        }
        select_store+='</select>';
        table.append('<tr><td>门店:<td>'+select_store+' <input type="hidden" name="stores" id="stores" data-options="required:true,missingMessage:\'亲！请增加门店！\'" /><br />排序值:<input class="easyui-numberspinner" value="100" name="sorts" id="sorts" style="width:50px;" data-options="required:true,missingMessage:\'亲！排序值？\'"><a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:\'icon-add\'" style="width:100px;" id="store_add">增加</a>');
        table.append('<tr><td><td id="td_stores"><ul style="list-style: none;margin-left:-40px;"></ul>');

        form.append(table);

        var contents=[form];
        $('#'+win_id).dialog({
            title:'编辑',
            width:500,
            height:400,
            modal:true,
            content:contents,
            minimizable:false,
            maximizable:false,
            collapsible:false,
            buttons: [{
                text:'提交',
                iconCls:'icon-save',
                handler:function(){
                    $.messager.progress();
                    $('#form_edit_app').form('submit', {
                        url:'/admin/app/action/edit?modify='+appInfo.id,
                        onSubmit: function(param){
                            var r=$(this).form("validate");
                            if(!r){$.messager.progress('close');return false;}
                            if(this.stores.value==""){$.messager.alert('提示','请增加门店！',"info");$.messager.progress('close');return false;}
                            return true;
                        },
                        success: function(data){
                            $.messager.progress('close');
                            var data = eval('(' + data + ')');  // change the JSON string to javascript object
                            if(data.data){
                                $.messager.alert('提示',"编辑成功");
                                window.location.reload();
                                return;
                            }
                            $.messager.alert('提示',data.message);
                            return;

                        }
                    });
                }
            },{
                text:'关闭',
                handler:function(){
                    $('#'+win_id).dialog('close');return;
                }
            }]
        });

        $('#form_edit_app').form('load',{
            status:1
        });
        $('#form_edit_app #store_add').bind('click',function(){
            var storeValue=$('#form_edit_app #allStore').combobox('getValue');
            var storeName=$('#form_edit_app #allStore').combobox('getText');
            var stores=$('#form_edit_app #stores').val();
            var stores_sort=$('#form_edit_app #sorts').val();
            if(stores_sort==undefined) {$.messager.alert('提示',"请填写门店排序！");return;}
            var stores_arr=stores.split(",");
            for(var i=0;i<stores_arr.length;i++){
                if(stores_arr[i]==storeValue){
                    $.messager.alert('提示',"已经添加过啦！！");return;
                }
            }
            var show='<li style="float:left;display:block;margin-left:10px;" id="store_id_'+storeValue+'">'+storeName+'->'+stores_sort+'<input type="hidden" name="sort['+storeValue+']" value="'+stores_sort+'"> <a href="javascript:void(0)" class="easyui-linkbutton" style="width:10px;height:10px;color:red;" value="'+storeValue+'">X</a></li>';
            $('#form_edit_app #td_stores ul').append(show);

            if(stores!=""){stores_arr.push(storeValue);
                $('#form_edit_app #stores').val(stores_arr);
            }else{
                $('#form_edit_app #stores').val(storeValue);
            }
            bind_edit_win_delete_stores();
        });
        load_edit_info(appInfo);
    }

    function load_edit_info(appInfo){
        $('#form_edit_app').form('load',{
            name:appInfo.name,
            link:appInfo.link,
            style:appInfo.style,
            status:appInfo.status
        });
        if(appInfo.img.length>0){
            $('#form_edit_app #span_img').append('<a href="'+appInfo.img+'" target="_blank" text="点击打开原图"><img src="'+appInfo.img+'" style="width:20px;height:20px;" /></a>');
        }
        if(appInfo.stores.length>0){
            var default_stores=appInfo.stores;
            var stores=[]
            for(var i=0;i<default_stores.length;i++){
                stores.push(default_stores[i]['id']);
                if(allStore[default_stores[i]['id']]){
                    show='<li style="float:left;display:block;margin-left:10px;" id="store_id_'+default_stores[i]['id']+'">'+default_stores[i]['name']+'->'+default_stores[i]['sort']+'<input type="hidden" name="sort['+default_stores[i]['id']+']" value="'+default_stores[i]['sort']+'"> <a href="javascript:void(0)" class="easyui-linkbutton" style="width:10px;height:10px;color:red;" value="'+default_stores[i]['id']+'">X</a></li>';
                }else{
                    show='<li style="float:left;display:block;margin-left:10px;" id="store_id_'+default_stores[i]['id']+'">'+default_stores[i]['name']+'->'+default_stores[i]['sort']+'<input type="hidden" name="sort['+default_stores[i]['id']+']" value="'+default_stores[i]['sort']+'">';
                }

                $('#form_edit_app #td_stores ul').append(show);
                $('#form_edit_app').form('load',{
                    stores:stores
                });
            }

            bind_edit_win_delete_stores();
        }
    }
    function bind_edit_win_delete_stores(){
        $('#form_edit_app #td_stores ul li a').unbind('click').bind('click',function(){
            var delStoreId=$(this).attr('value');
            var stores=$('#form_edit_app #stores').val();
            var stores_arr=stores.split(",");
            var newStore=[];
            for(var i=0;i<stores_arr.length;i++){
                if(stores_arr[i]!=delStoreId){
                    newStore.push(stores_arr[i]);
                }
            }
            $('#form_edit_app #td_stores ul #store_id_'+delStoreId).remove();
            $('#form_edit_app #stores').val(newStore);
            return;

        });
    }

    function show_win(appInfo){

        var win_id='win_show_app-div';
        if($('#'+win_id).length<1){
            $('body').append('<div id="'+win_id+'"></div>');
        }
        var form=$('<form id="form_show_app" method="POST" enctype="multipart/form-data" ></form>');
        var table=$("<table style='width:90%;margin:0 auto;margin-top:10px;cellspacing:5px;'></table>");
        table.append('<tr><td style="width:70px;">名称:<td><input class="easyui-textbox" name="name" style="width:150px;" data-options="" readonly>');
        table.append('<tr><td>ICON:<td><span id="span_img"></span>');
        table.append('<tr><td>链接:<td><input class="easyui-textbox" name="link" style="width:150px;" data-options="" readonly>');
        table.append('<tr><td>样式:<td><input class="easyui-textbox" name="style" style="width:150px;height:80px;" data-options="multiline:true" readonly>');

        table.append('<tr><td>状态:<td>'+isuse[appInfo.status]);
        table.append('<tr><td>门店:<td id="td_stores"><ul style="list-style: none;margin-left:-50px;"></ul>');
        form.append(table);
        var contents=[form];
        $('#'+win_id).window({
            title:'显示',
            width:500,
            height:400,
            modal:true,
            content:contents,
            minimizable:false,
            maximizable:false,
            collapsible:false
        });
        if(appInfo.stores.length>0){
            var default_stores=appInfo.stores;
            for(var i=0;i<default_stores.length;i++){
                showContent='<li style="float:left;display:block;margin-left:10px;" id="store_id_'+default_stores[i]['id']+'">'+default_stores[i]['name']+'->'+default_stores[i]['sort'];
                $('#'+win_id+' #td_stores ul').append(showContent);

            }
        }
        if(appInfo.img.length>0){
            $('#form_show_app #span_img').append('<a href="'+appInfo.img+'" target="_blank" text="点击打开原图"><img src="'+appInfo.img+'" style="width:20px;height:20px;" /></a>');
        }

        $('#form_show_app').form('load',{
            name:appInfo.name,
            link:appInfo.link,
            style:appInfo.style
        });

    }

</script>
@endsection