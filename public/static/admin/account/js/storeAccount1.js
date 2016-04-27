/**
 * Created by 10000716 on 2015/9/1.
 */


$(function(){

    var edit = "更改";
    var save = "保存";

    //绑定点击事件

    $("#accountBtn").click(function(){
        if($(this).val() === edit){
            $("span","#accountForm .box-header ").each(function(){
                $(this).html('<input type="text" class="form-control" value="'+$(this).text()+'"/>');
            });
            $(this).val(save);

        }else{
            $("span","#accountForm .box-header ").each(function(){
                $(this).html($(this).children("input")[0].value);
            });
            $(this).val(edit);
        }
    });

    $("#adminBtn").click(function(){
        if($(this).val() === edit){
            $("input[type='checkbox']","#adminForm .box-header .checkbox").each(function(){
                $(this).removeAttr("disabled");
            });
            $(this).val(save);
            //disabled
        }else{
            $("input[type='checkbox']","#adminForm .box-header .checkbox").each(function(){
                $(this).attr("disabled","disabled");
            });
            $(this).val(edit);
        }
    });

    $("#operationBtn").click(function(){
        if($(this).val() === edit){
            $("input[type='checkbox']","#operationForm  .checkbox").each(function(){
                $(this).removeAttr("disabled");
            });
            $(this).val(save);
            //disabled
        }else{
            $("input[type='checkbox']","#operationForm  .checkbox").each(function(){
                $(this).attr("disabled","disabled");
            });
            $(this).val(edit);
        }
    });


});

