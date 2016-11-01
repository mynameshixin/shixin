/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2016-07-10 21:37:30
 * @version $Id$
 */
 var data = [
    "请选择一个文件夹",
    "椅子",
    "桌子",
    "电视",
    "沙发",
    "卧室",
    "椅子",
    "桌子",
    "电视",
    "卧室"
];
$(function(){
		$(document).keydown(function(e){
        e = e || window.event;
        var keycode = e.which ? e.which : e.keyCode;
        if(keycode == 38){
            if(jQuery.trim($("#append").html())==""){
                return;
            }
            movePrev();
        }else if(keycode == 40){
            if(jQuery.trim($("#append").html())==""){
                return;
            }
            $("#kw").blur();
            if($(".item").hasClass("addbg")){
                moveNext();
            }else{
                $(".item").removeClass('addbg').eq(0).addClass('addbg');
            }
           
        }else if(keycode == 13){
            dojob();
        }
    });

    var movePrev = function(){
        $("#kw").blur();
        var index = $(".addbg").prevAll().length;
        if(index == 0){
            $(".item").removeClass('addbg').eq($(".item").length-1).addClass('addbg');
        }else{
            $(".item").removeClass('addbg').eq(index-1).addClass('addbg');
        }
    }
   
    var moveNext = function(){
        var index = $(".addbg").prevAll().length;
        if(index == $(".item").length-1){
            $(".item").removeClass('addbg').eq(0).addClass('addbg');
        }else{
            $(".item").removeClass('addbg').eq(index+1).addClass('addbg');
        }
       
    }
   
    var dojob = function(){
        $("#kw").blur();
        var value = $(".addbg").text();
        $("#kw").val(value);
        $("#append").html("");
    }
})
function getContent(obj){
    var kw = jQuery.trim($(obj).val());
    if(kw == ""){
        $("#append").html("");
        return false;
    }
    var html = "";
    for (var i = 0; i < data.length; i++) {
        if (data[i].indexOf(kw) >= 0) {

            html = html + "<div class='item' onmouseenter='getFocus(this)' onClick='getCon(this);'>" + data[i] + "</div>"
        }
    }
    if(html != ""){
    	console.info(html)
        $("#append").html(html);
        console.info($("#append").html())
    }else{
        $("#append").html("");
    }
}
function getFocus(obj){
    $(".item").removeClass("addbg");
    $(obj).addClass("addbg");
}
function getCon(obj){
    var value = $(obj).text();
    $("#kw").val(value);
    $("#append").html("");
}