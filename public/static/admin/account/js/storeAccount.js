
$(function(){
    //绑定账户情况点击事件
    editorFn("text",$("#accountBtn"),$("#accountForm .form-group "));
    //绑定角色编辑点击事件
    editorFn("checkbox",$("#adminBtn"),$("input[type='radio']","#adminForm .form-group .checkbox"));
    ////绑定运营权限点击事件
    //editorFn("checkbox",$("#operationBtn"),$("input[type='checkbox']","#operationForm  .checkbox"));
    ////checkbox效果
    //checkboxFn( $("input[type='checkbox']",".editorMain"));

    if(typeof tree != 'undefined' && typeof url != 'undefined'){
        var treeFn = new permissionTree();
        treeFn.init(tree);
    }



});


/**
 * 权限树初始化
 */
function permissionTree (){
    this.init = function (tree) {
        for(i in tree){
            appendHtml(tree[i]);
            loadTree(tree[i]);
        }
    };
    var appendHtml = function (treeObj) {
        var treeid = treeObj.id;
        var showText ='<div class="box-header with-border pers-title">'
            + '<b>'+treeObj.text+'</b>';

        if(typeof isEdit != 'undefined' && isEdit==true){
            showText += '<input class="menu-btn" type="button" value="更改" id="i-btn-'+treeid+'" onclick="checkClickFn('+treeid+' )" />';
        }
        showText += '</div>'
        + '<form id="i-form-'+treeid+'">'
        + '<ul id="i-tree-'+treeid+'" class="tree-data" ></ul>'
        + ' </form>';
        $("#permission").append(showText);
    };

    var loadTree = function (treeObj) {
        $("#i-tree-"+treeObj.id).tree({
            checkbox : true,
            animate : true,
            data : treeObj.children,
            onLoadSuccess : function (node, data) {
                $(this).tree("options").onBeforeCheck = function () {
                    return false;
                };
            }
        });
    };
}



/**
 * 按钮点击事件-改变复选款的样式
 * @param elem
 */
function checkClickFn(elem){
    var save = "保存";
    var edit = "更改";
    var mark = "node-name = perm";
    var obj = {};

    if($("#i-btn-" + elem).val() === edit){
        $("#i-tree-" + elem).tree("options").onBeforeCheck = function () {};
        $("#i-btn-" + elem).val(save);
    }else{
        $("#i-tree-" + elem).tree("options").onBeforeCheck = function () {return false;};
        //获取选中的权限
        var checkPerms = [];
        $(".tree").each(function () {
            var checkedArray = $(this).tree("getChecked",['checked','indeterminate']);
            //checkedArray = checkedArray.concat(arr);

            for(i in checkedArray){
                if(checkedArray[i].attributes === mark){
                    var children = $(this).tree("getChildren",checkedArray[i].target);
                    var count = 0;
                    if(children && children.length > 0){

                        for(c in children){
                            if(children[c].checked){
                                count += parseInt(children[c].value);
                            }
                        }
                        if(count>2){
                            count = 2;
                        }
                    }else{
                        count = 2;
                    }
                    obj[checkedArray[i].id] = count;

                }
            }
        });


        //获取用户ID
        var submitObj = {
            user_id : $("#user_id").val(),
            id : $("#id").val(),
            //permissions : JSON.stringify(checkPerms)
            permissions : JSON.stringify(obj)
        };
        //console.log(submitObj);

        $.post(url,submitObj, function (data) {
            //console.log(data);
            $.messager.alert('提示', data.message);
             //alert(data.message);
        }).error(function (data) {
            //console.log("请求失败：" + data);
            $.messager.alert('请求失败');
        });


        $("#i-btn-" + elem).val(edit);
    }

}

/**
 * 初始化页面编辑按钮事件
 * @param type
 * @param clickObj
 * @param changesObj
 */
function editorFn(type, clickObj, changesObj) {
    var edit = "更改";
    var save = "保存";

    this.init = function (type) {
        switch (type) {
            case 'text' :
                initText(clickObj,changesObj);
                break;
            case  'checkbox' :
                initCheckbox(clickObj,changesObj);
                break;
        }

    };
    var initCheckbox = function () {
        clickObj.click(function () {
            if ($(this).val() === edit) {
                changesObj.each(function () {
                    $(this).removeAttr("disabled");
                });
                $(this).val(save);
            } else {
                //点击保存-将用户编辑的数据发送给后端
                changesObj.each(function () {
                    $(this).attr("disabled", "disabled");
                });
                $(this).val(edit);
            }
        });
    };
    var initText = function (clickObj,changesObj) {
        clickObj.click(function () {
            if ($(this).val() === edit) {

                $(changesObj).find("span").each(function () {
                    $(this).html('<input type="text" class="form-control input-sm" name="' + $(this).attr("name") + '" value="' + $(this).text() + '" placeholder=".input-sm" />');
                });
                $(changesObj).find("input[type='radio']").each(function () {
                    $(this).removeAttr("disabled");
                });
                //<input class="form-control input-sm" type="text" placeholder=".input-sm">

                $(this).val(save);

            } else {
                //点击保存-将用户编辑的数据发送给后端
                $(changesObj).find("span").each(function () {
                    $(this).html($(this).children("input")[0].value);
                });
                $(changesObj).find("input[type='radio']").each(function () {
                    $(this).attr("disabled", "disabled");
                });
                $(this).val(edit);
            }
        });
    }
    this.init(type);
};




