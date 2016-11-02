/**
 * 
 * @authors Crystal (1291124482@qq.com)
 * @date    2016-04-16 15:55:29
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
    // function getContent(obj){
    //     alert(0);
    //     var kw = jQuery.trim(obj.val());
    //     if(kw == ""){
    //         $("#append").html("");
    //         return false;
    //     }
    //     var html = "";
    //     for (var i = 0; i < data.length; i++) {
    //         if (data[i].indexOf(kw) >= 0) {
    //             html = html + "<div class='item' onmouseenter='getFocus(this)' onClick='getCon(this);'>" + data[i] + "</div>"
    //         }
    //     }
    //     if(html != ""){
    //       console.info(html)
    //         $("#append").html(html);
    //         console.info($("#append").html())
    //     }else{
    //         $("#append").html("");
    //     }
    // }
    function getFocus(obj){
        $(".item").removeClass("addbg");
        obj.addClass("addbg");
    }
    function getCon(obj){
        var value = obj.text();
        $("#kw").val(value);
        $("#append").html("");
    }
  $('body').append('<a href="javascript:;" class="back_to_top">^</a>');
  $('.back_to_top').click(function(){
    $("html,body").animate({scrollTop: 0},600);
  });
  
	var mleft = $('.container').css('marginLeft')
        $('.headercontainer').css({
          'left':mleft
        });
        $(window).resize(function(){
          var mleft = $('.container').css('marginLeft')
          $('.headercontainer').css({
            'left':mleft
          })
        })
          
	$(window).scroll(function(event) {
		var x = document.body.scrollLeft; 
          if (x>0) {
              $('.headercontainer').css({
                'left':-x
              })
            }else{
              var mleft = $('.container').css('marginLeft')
              $('.headercontainer').css({
                'left':mleft
              });
      	};
	});
  
  // $('.index_item_intro').addClass()
  function addPoint(){
    $(".index_item_intro").each(function(i) {
        var vh = 44;
        var $vp = $(".word", $(this));
        while ($vp.outerHeight() > vh){
            $vp.text($vp.text().replace(/(\s)*([a-zA-Z0-9]+|\W)(\.\.\.)?$/,"..."));
        };
    });
  }
 
  $('.header_more_a2').click(function(){
    $('.pop_goodsupload').hide();
    $('.pop_uploadgoods').show();
    var popconHei = $('.pop_uploadgoods .pop_con').height();
    $('.pop_con').css({
       'margin-top':-(popconHei/2)
    })
  });
  $('.detail_pop_goodsget').click(function(){
    $('.pop_uploadgoods').hide();
    $('.pop_goods_upload').show();
    var popconHei = $('.pop_goods_upload .pop_con').height();
      if (popconHei > 410) {
        $('.pop_goods_upload .pop_conwrap').css({
          'max-height':410,
          'overflow-y':'scroll'
        })
      };
    var poptopHei = $('.pop_goods_upload .pop_con').height();
    $('.pop_goods_upload .pop_con').css({
       'margin-top':-(poptopHei/2)
    })
  });
  // htmlv?=20160720
  var buildnewfoldbtn = '<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball pop_newfold_createbtn" style="margin:20px;">新建文件夹</a>';
  $('.pop_iptselect').parent('.pop_namewrap').append(buildnewfoldbtn);
  $('.pop_newfold_createbtn').click(function(){

  })
 
  $('.pop_uploadgoods,.pop_uploadgoods .detail_pop_cancel,.pop_uploadgoods .pop_close').click(function(){
    $('.pop_uploadgoods').hide();
  });
  $('.pop_newfold_createbtn').click(function(){
    $('.pop_goods_upload').hide();
    $('.pop_addfold').css({
      display: 'block'
    });
    var poptopHei = $('.pop_addfold .pop_con').height();
    $('.pop_addfold .pop_con').css({
       'margin-top':-(poptopHei/2)
    })
    $('.pop_addprivfold').css({
      display: 'none'
    });
  });
   // htmlv?=20160720
  $(".pop_upload_a").on("change","input[type='file']",function(){
    var filePath=$(this).val();
    if(filePath.indexOf("jpg")!=-1 || filePath.indexOf("png")!=-1 ||filePath.indexOf("JPG")!=-1 || filePath.indexOf("gif")!=-1 || filePath.indexOf("JPEG")!=-1 || filePath.indexOf("jpeg")!=-1){
        var arr=filePath.split('\\');
        var fileName=arr[arr.length-1];
        $(".pop_upload_a span").html(fileName);
        $('.pop_uploadfile').hide();
        $('.pop_choose_already').show();
         var poptopHei = $('.pop_choose_already .pop_con').height();
        $('.pop_choose_already .pop_con').css({
           'margin-top':-(poptopHei/2)
        })
        var popH =$('.pop_choose_already').show().find('.pop_con').height();
        $('.pop_choose_already').show().find('.pop_col_left').height(popH-40);
        $('.point_to_a').click(function(){
          $('.pop_col_colum_wrap').animate({
            scrollTop: 50},
            300);
        })
        $('.point_to_d').click(function(){
          $('.pop_col_colum_wrap').animate({
            scrollTop: 100},
            300);
        });
        $(".pop_upload_a span").html("请选择文件");
        // alert(0)
    }else{
        $(".pop_upload_a span").html("您上传文件类型有误！");
        return false 
    }
  })
  $('.detail_pop_collection').click(function(){

    $('.pop_choose_already').show();
     var poptopHei = $('.pop_choose_already .pop_con').height();
    $('.pop_con').css({
       'margin-top':-(poptopHei/2)
    })
    
    var popH =$('.pop_choose_already').show().find('.pop_con').height();
    $('.pop_choose_already').show().find('.pop_col_left').height(popH-40);
    $('.point_to_a').click(function(){
      $('.pop_col_colum_wrap').animate({
        scrollTop: 50},
        300);
    })
    $('.point_to_d').click(function(){
      $('.pop_col_colum_wrap').animate({
        scrollTop: 100},
        300);
    })
  });
  $('.pop_choose_already,.pop_close,.detail_pop_cancel').click(function(){
    $('.pop_choose_already').hide()
  });
  $('.pop_con').click(function(){
    event.stopPropagation()
  })
  // 私信弹窗
  // htmlv?=20160720 
  $('.otherhome_sendmess').click(function(){
    $('.pop_letter').show();
    // alert($('.letter_ulwrap')[0].scrollHeight);
    $(".letter_ul").animate({ scrollTop: $('.letter_ulwrap')[0].scrollHeight}, 800);
    var poptopHei = $('.pop_letter .pop_con').height();
    $('.pop_con').css({
       'margin-top':-(poptopHei/2)
    })
    sendMess()
  });
  function sendMess(){
    $('#send_new_message').click(function(){
      var sendtextArea = $('.letter_textarea textarea').val();
      if (sendtextArea == "") {
        alert("请输入留言")
      }else{
        var messHtml = $('<li class="clearfix letter_ulright">\
          <span class="letter_rel">'+sendtextArea+'</span>\
          <div class="letter_avawrap">\
            <img src="public/images/temp_avatar.JPG" alt="">\
          </div>\
        </li>');
        $('.letter_ul').append(messHtml);
        $(".letter_ul").animate({ scrollTop: $('.letter_ulwrap')[0].scrollHeight}, 800);
        $('.letter_textarea textarea').val("")
      };
    })
  }
  // htmlv?=20160720 
  // htmlv?=20160720
  $('.pop_con').click(function(){
    event.stopPropagation();
  })
  $('.pop_letter,.pop_letter .pop_close,.pop_letter .detail_pop_cancel').click(function(){
    $('.pop_letter').hide()
  })
  // htmlv?=20160720
  $('.header_more_a3').click(function(event) {
    $('.pop_goods_upload').hide()
    if ($(this).hasClass('perhome_add_fold')) {
      $('.pop_addprivfold').css({
        display: 'block'
      });
      var poptopHei = $('.pop_addprivfold .pop_con').height();
      $('.pop_addprivfold .pop_con').css({
         'margin-top':-(poptopHei/2)
      })
      $('.pop_addfold').css({
        display: 'none'
      });
    }else{
      $('.pop_addfold').css({
        display: 'block'
      });
      var poptopHei = $('.pop_addfold .pop_con').height();
      $('.pop_addfold .pop_con').css({
         'margin-top':-(poptopHei/2)
      })
      $('.pop_addprivfold').css({
        display: 'none'
      });
    };
  });
  // htmlv?=20160720
  $('.pop_addfold,.pop_addprivfold,.pop_close,.detail_pop_cancel').click(function(){
    $('.pop_addfold,.pop_addprivfold').css({
      display:'none'
    })
  });
  $('.header_more_a5').click(function(){
    $('.pop_uploadvr').show();
    var poptopHei = $('.pop_uploadvr .pop_con').height();
    $('.pop_uploadvr .pop_con').css({
       'margin-top':-(poptopHei/2)
    })
    $('.detail_pop_tbtn').css({'position':'relative'})
    $('.detail_pop_tbtn').append('<input type="file">')
      
      // htmlv?=20160707
        $('.detail_pop_tbtn input').change(function(){
        var imgcon = $('.pop_vrimgwrap');
        if (this.files && this.files[0]) {
          var filename = this.files[0].name;
          var subfile = filename.split('.');
          var subfilelen = subfile.length;
          var last = subfile[subfilelen-1].toLowerCase();
          var tp ="jpg,gif,bmp,png,jpeg";
          var rs=tp.indexOf(last);
          if(rs>=0){
            var reader = new FileReader();
            reader.onload = function(evt){
              $('.pop_vrimgwrap img').attr('src', evt.target.result);
            }
            reader.readAsDataURL(this.files[0]);
          }else{
            alert("您选择的上传文件不是有效的图片文件！请重新选择");
            return false;
          }
        } else{
          // imgcon.html('<img class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + evt.target.result + '\'">')
        };
      });
      // htmlv?=20160707
  });
  $('.detail_pop_myvredit').click(function(){
	$('.pop_editvr').show();
	var poptopHei = $('.pop_editvr .pop_con').height();
    $('.pop_editvr .pop_con').css({
       'margin-top':-(poptopHei/2)
    })
})
// <!-- htmlv=20160718 -->
  $('.pop_editvr,.pop_close,.detail_pop_cancel').click(function(){
    $('.pop_editvr').hide()
  })
  $('.pop_uploadvr,.pop_close,.detail_pop_cancel').click(function(){
    $('.pop_uploadvr').hide()
  })
  // <!-- htmlv=20160718 -->
  $('.pop_uploadvr .pop_con').click(function(){
    event.stopPropagation()
  })
  cutFont()
})
function cutFont(){
  $('.index_item_intro').each(function(){
    var text = $(this),
        str = text.html(),
        textLeng = 27;
    if (str.length > textLeng) {
      text.html(str.substring(0,textLeng )+"...");
    };
  })
  $('.index_item_l').click(function(event){
    if ($(this).hasClass('index_item_lon')) {
      $(this).removeClass('index_item_lon');
       event.stopPropagation();
    }else{
      $(this).addClass('index_item_lon');
      event.stopPropagation();
    };
  });
  $('.detail_pop_tbtnlike').click(function(){
    if ($(this).hasClass('detail_pop_tbtnlikeon')) {
      $(this).removeClass('detail_pop_tbtnlikeon');
    }else{
      $(this).addClass('detail_pop_tbtnlikeon');
    };
  })
  // htmlv=20160710
  
  // htmlv?=20160710
// <!-- htmlv?=20160718 -->
      
      var collectionhtml = '<div class="pop_collect pop_choose" id="allcollect">\
          <div class="pop_con">\
            <div class="pop_col_left">\
              <div class="pop_col_ltop clearfix">\
                <img src="public/images/temp/pop_img.png" alt="">\
                <div class="pop_col_dwrap clearfix">\
                  <textarea class="pop_col_detailtext" title="富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅" style="resize: none;">富有海的味道的客厅#室内设计#让新房的...</textarea>\
                </div>\
                <a href="javascript:;" class="detail_pop_colledit"></a>\
              </div>\
              <div class="pop_col_lbtm">\
                <span class="pop_col_lbshare">\
                  分享到 :\
                </span>\
                &nbsp;\
                <span class="pop_col_bwrap">\
                  <a href="javascript:;" class="pop_col_r pop_col_radio_on"></a>\
                  <a class="pop_col_lbswc"></a>\
                  <a class="jiathis_button_weixin jiathis_button jiathis_button_on"></a>\
                </span>\
                <span class="pop_col_lbshare">\
                  微信朋友圈\
                </span>\
                &nbsp;\
                <span class="pop_col_bwrap">\
                  <a href="javascript:;" class="pop_col_r pop_col_radio"></a>\
                  <a class="pop_col_lbsqq"></a>\
                  <a class="jiathis_button_qzone jiathis_button"></a>\
                </span>\
                <span class="pop_col_lbshare">\
                  QQ空间\
                </span>\
                <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>\
              </div>\
            </div>\
            <div class="pop_col_right">\
              <div class="pop_col_tit">\
                选择文件夹\
                <span class="pop_close"></span>\
                <p class="pop_col_tips">\
                  该文件已采集到<a href="javascript:;">工业风格</a>文件夹\
                </p>\
                <div class="pop_col_sinput_wrap">\
                  <a href="javascript:;" class="pop_col_sinputbtn"></a>\
                  <input class="pop_col_sinput" placeholder="搜索" id="kw">\
                </div>\
              </div>\
              <div class="pop_col_alpwrap">\
                <div class="pop_col_colum_wrap">\
                  <div class="pop_col_alphabet">\
                    <a href="#A" class="pop_col_alpbtn point_to_1">A</a>\
                    <a href="#B" class="pop_col_alpbtn point_to_2">B</a>\
                    <a href="#C" class="pop_col_alpbtn point_to_3">C</a>\
                    <a href="#D" class="pop_col_alpbtn point_to_4">D</a>\
                    <a href="#E" class="pop_col_alpbtn point_to_5">E</a>\
                    <a href="#F" class="pop_col_alpbtn point_to_6">F</a>\
                    <a href="#G" class="pop_col_alpbtn point_to_7">G</a>\
                    <a href="#H" class="pop_col_alpbtn point_to_8">H</a>\
                    <a href="#I" class="pop_col_alpbtn point_to_9">I</a>\
                    <a href="#A" class="pop_col_alpbtn point_to_10">J</a>\
                    <a href="#A" class="pop_col_alpbtn point_to_11">K</a>\
                    <a href="#A" class="pop_col_alpbtn point_to_12">L</a>\
                    <a href="#A" class="pop_col_alpbtn point_to_13">M</a>\
                    <a href="#A" class="pop_col_alpbtn point_to_14">N</a>\
                    <a href="#A" class="pop_col_alpbtn point_to_15">O</a>\
                    <a href="#A" class="pop_col_alpbtn point_to_16">P</a>\
                    <a href="#A" class="pop_col_alpbtn point_to_17">Q</a>\
                    <a href="#A" class="pop_col_alpbtn point_to_18">R</a>\
                    <a href="#A" class="pop_col_alpbtn point_to_19">S</a>\
                    <a href="#A" class="pop_col_alpbtn point_to_20">T</a>\
                    <a href="#A" class="pop_col_alpbtn point_to_21">U</a>\
                    <a href="#A" class="pop_col_alpbtn point_to_22">V</a>\
                    <a href="#A" class="pop_col_alpbtn point_to_23">W</a>\
                    <a href="#A" class="pop_col_alpbtn point_to_24">X</a>\
                    <a href="#A" class="pop_col_alpbtn point_to_25">Y</a>\
                    <a href="#A" class="pop_col_alpbtn point_to_26">Z</a>\
                  </div>\
                  <p class="pop_col_new">最新采集到</p>\
                  <ul class="pop_col_colum pop_col_colum_new">\
                    <li class="pop_col_colum_on clearfix">\
                      <div class="pop_col_colava">\
                        <a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>\
                      </div>\
                      <div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>\
                      <a class="pop_col_foldlock"></a>\
                      <a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>\
                    </li>\
                    <li class="pop_col_colum_on clearfix">\
                      <div class="pop_col_colava">\
                        <a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>\
                      </div>\
                      <div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>\
                      <a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>\
                    </li>\
                    <li class="pop_col_colum_on clearfix">\
                      <div class="pop_col_colava">\
                        <a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>\
                      </div>\
                      <div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>\
                      <a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>\
                    </li>\
                  </ul>\
                  <p class="pop_col_new">所有文件夹</p>\
                  <ul class="pop_col_colum pop_col_colum_all"></ul>\
                </div>\
              </div>\
              <div class="pop_add_foldbtn clearfix">\
                <a href="javascript:;" class="pop_add_addnew">+</a>\
                <p class="pop_add_addfont">新建文件夹</p>\
              </div>\
            </div>\
          </div>\
        </div>';

 // console.log(allfoldNamelen)
var allfoldName = [
{"classname":"foldtopname1","foldname":"Angola安哥拉"},
{"classname":"foldtopname1","foldname":"Afghanistan阿富汗"},
{"classname":"foldtopname1","foldname":"Albania阿尔巴尼亚"},
{"classname":"foldtopname1","foldname":"Algeria阿尔及利亚"},
{"classname":"foldtopname1","foldname":"Andorra安道尔共和国"},
{"classname":"foldtopname1","foldname":"Anguilla安圭拉岛"},
{"classname":"foldtopname1","foldname":"AntiguaandBarbuda安提瓜和巴布达"},
{"classname":"foldtopname1","foldname":"Argentina阿根廷"},
{"classname":"foldtopname1","foldname":"Armenia亚美尼亚"},
{"classname":"foldtopname1","foldname":"Ascension阿森松"},
{"classname":"foldtopname1","foldname":"Australia澳大利亚"},
{"classname":"foldtopname1","foldname":"Austria奥地利"},
{"classname":"foldtopname1","foldname":"Azerbaijan阿塞拜疆"},
{"classname":"foldtopname2","foldname":"Bahamas巴哈马"},
{"classname":"foldtopname2","foldname":"Bahrain巴林"},
{"classname":"foldtopname2","foldname":"Bangladesh孟加拉国"},
{"classname":"foldtopname2","foldname":"Barbados巴巴多斯"},
{"classname":"foldtopname2","foldname":"Belarus白俄罗斯"},
{"classname":"foldtopname2","foldname":"Belgium比利时"},
{"classname":"foldtopname2","foldname":"Belize伯利兹"},
{"classname":"foldtopname2","foldname":"Benin贝宁"},
{"classname":"foldtopname2","foldname":"BermudaIs.百慕大群岛"},
{"classname":"foldtopname2","foldname":"Bolivia玻利维亚"},
{"classname":"foldtopname2","foldname":"Botswana博茨瓦纳"},
{"classname":"foldtopname2","foldname":"Brazil巴西"},
{"classname":"foldtopname2","foldname":"Brunei文莱"},
{"classname":"foldtopname2","foldname":"Bulgaria保加利亚"},
{"classname":"foldtopname2","foldname":"Burkina-faso布基纳法索"},
{"classname":"foldtopname2","foldname":"Burma缅甸"},
{"classname":"foldtopname2","foldname":"Burundi布隆迪"},
{"classname":"foldtopname3","foldname":"Cameroon喀麦隆"},
{"classname":"foldtopname3","foldname":"Canada加拿大"},
{"classname":"foldtopname3","foldname":"CaymanIs.开曼群岛"},
{"classname":"foldtopname3","foldname":"CentralAfricanRepublic中非共和国"},
{"classname":"foldtopname3","foldname":"Chad乍得"},
{"classname":"foldtopname3","foldname":"Chile智利"},
{"classname":"foldtopname3","foldname":"China中国"},
{"classname":"foldtopname3","foldname":"Colombia哥伦比亚"},
{"classname":"foldtopname3","foldname":"Congo刚果"},
{"classname":"foldtopname3","foldname":"CookIs.库克群岛"},
{"classname":"foldtopname3","foldname":"CostaRica哥斯达黎加"},
{"classname":"foldtopname3","foldname":"Cuba古巴"},
{"classname":"foldtopname3","foldname":"Cyprus塞浦路斯"},
{"classname":"foldtopname3","foldname":"CzechRepublic捷克"},
{"classname":"foldtopname4","foldname":"Denmark丹麦"},
{"classname":"foldtopname4","foldname":"Djibouti吉布提"},
{"classname":"foldtopname4","foldname":"DominicaRep.多米尼加共和国"},
{"classname":"foldtopname5","foldname":"Ecuador厄瓜多尔"},
{"classname":"foldtopname5","foldname":"Egypt埃及"},
{"classname":"foldtopname5","foldname":"EISalvador萨尔瓦多"},
{"classname":"foldtopname5","foldname":"Estonia爱沙尼亚"},
{"classname":"foldtopname5","foldname":"Ethiopia埃塞俄比亚"},
{"classname":"foldtopname6","foldname":"Fiji斐济"},
{"classname":"foldtopname6","foldname":"Finland芬兰"},
{"classname":"foldtopname6","foldname":"France法国"},
{"classname":"foldtopname6","foldname":"FrenchGuiana法属圭亚那"},
{"classname":"foldtopname7","foldname":"Gabon加蓬"},
{"classname":"foldtopname7","foldname":"Gambia冈比亚"},
{"classname":"foldtopname7","foldname":"Georgia格鲁吉亚"},
{"classname":"foldtopname7","foldname":"Germany德国"},
{"classname":"foldtopname7","foldname":"Ghana加纳"},
{"classname":"foldtopname7","foldname":"Gibraltar直布罗陀"},
{"classname":"foldtopname7","foldname":"Greece希腊"},
{"classname":"foldtopname7","foldname":"Grenada格林纳达"},
{"classname":"foldtopname7","foldname":"Guam关岛"},
{"classname":"foldtopname7","foldname":"Guatemala危地马拉"},
{"classname":"foldtopname7","foldname":"Guinea几内亚"},
{"classname":"foldtopname7","foldname":"Guyana圭亚那"},
{"classname":"foldtopname8","foldname":"Haiti海地"},
{"classname":"foldtopname8","foldname":"Honduras洪都拉斯"},
{"classname":"foldtopname8","foldname":"Hongkong香港"},
{"classname":"foldtopname8","foldname":"Hungary匈牙利"},
{"classname":"foldtopname9","foldname":"Iceland冰岛"},
{"classname":"foldtopname9","foldname":"India印度"},
{"classname":"foldtopname9","foldname":"Indonesia印度尼西亚"},
{"classname":"foldtopname9","foldname":"Iran伊朗"},
{"classname":"foldtopname9","foldname":"Iraq伊拉克"},
{"classname":"foldtopname9","foldname":"Ireland爱尔兰"},
{"classname":"foldtopname9","foldname":"Israel以色列"},
{"classname":"foldtopname9","foldname":"Italy意大利"},
{"classname":"foldtopname9","foldname":"IvoryCoast科特迪瓦"},
{"classname":"foldtopname10","foldname":"Jamaica牙买加"},
{"classname":"foldtopname10","foldname":"Japan日本"},
{"classname":"foldtopname10","foldname":"Jordan约旦"},
{"classname":"foldtopname11","foldname":"Kampuchea(Cambodia)柬埔寨"},
{"classname":"foldtopname11","foldname":"Kazakstan哈萨克斯坦"},
{"classname":"foldtopname11","foldname":"Kenya肯尼亚"},
{"classname":"foldtopname11","foldname":"Korea韩国"},
{"classname":"foldtopname11","foldname":"Kuwait科威特"},
{"classname":"foldtopname11","foldname":"Kyrgyzstan吉尔吉斯坦"},
{"classname":"foldtopname12","foldname":"Laos老挝"},
{"classname":"foldtopname12","foldname":"Latvia拉脱维亚"},
{"classname":"foldtopname12","foldname":"Lebanon黎巴嫩"},
{"classname":"foldtopname12","foldname":"Lesotho莱索托"},
{"classname":"foldtopname12","foldname":"Liberia利比里亚"},
{"classname":"foldtopname12","foldname":"Libya利比亚"},
{"classname":"foldtopname12","foldname":"Liechtenstein列支敦士登"},
{"classname":"foldtopname12","foldname":"Lithuania立陶宛"},
{"classname":"foldtopname12","foldname":"Luxembourg卢森堡"},
{"classname":"foldtopname13","foldname":"Macao澳门"},
{"classname":"foldtopname13","foldname":"Madagascar马达加斯加"},
{"classname":"foldtopname13","foldname":"Malawi马拉维"},
{"classname":"foldtopname13","foldname":"Malaysia马来西亚"},
{"classname":"foldtopname13","foldname":"Maldives马尔代夫"},
{"classname":"foldtopname13","foldname":"Mali马里"},
{"classname":"foldtopname13","foldname":"Malta马耳他"},
{"classname":"foldtopname13","foldname":"MarianaIs马里亚那群岛"},
{"classname":"foldtopname13","foldname":"Martinique马提尼克"},
{"classname":"foldtopname13","foldname":"Mauritius毛里求斯"},
{"classname":"foldtopname13","foldname":"Mexico墨西哥"},
{"classname":"foldtopname13","foldname":"Moldova,Republicof摩尔多瓦"},
{"classname":"foldtopname13","foldname":"Monaco摩纳哥"},
{"classname":"foldtopname13","foldname":"Mongolia蒙古"},
{"classname":"foldtopname13","foldname":"MontserratIs蒙特塞拉特岛"},
{"classname":"foldtopname13","foldname":"Morocco摩洛哥"},
{"classname":"foldtopname13","foldname":"Mozambique莫桑比克"},
{"classname":"foldtopname14","foldname":"Namibia纳米比亚"},
{"classname":"foldtopname14","foldname":"Nauru瑙鲁"},
{"classname":"foldtopname14","foldname":"Nepal尼泊尔"},
{"classname":"foldtopname14","foldname":"NetheriandsAntilles荷属安的列斯"},
{"classname":"foldtopname14","foldname":"Netherlands荷兰"},
{"classname":"foldtopname14","foldname":"NewZealand新西兰"},
{"classname":"foldtopname14","foldname":"Nicaragua尼加拉瓜"},
{"classname":"foldtopname14","foldname":"Niger尼日尔"},
{"classname":"foldtopname14","foldname":"Nigeria尼日利亚"},
{"classname":"foldtopname14","foldname":"NorthKorea朝鲜"},
{"classname":"foldtopname14","foldname":"Norway挪威"},
{"classname":"foldtopname15","foldname":"Oman阿曼"},
{"classname":"foldtopname16","foldname":"Pakistan巴基斯坦"},
{"classname":"foldtopname16","foldname":"Panama巴拿马"},
{"classname":"foldtopname16","foldname":"PapuaNewCuinea巴布亚新几内亚"},
{"classname":"foldtopname16","foldname":"Paraguay巴拉圭"},
{"classname":"foldtopname16","foldname":"Peru秘鲁"},
{"classname":"foldtopname16","foldname":"Philippines菲律宾"},
{"classname":"foldtopname16","foldname":"Poland波兰"},
{"classname":"foldtopname16","foldname":"FrenchPolynesia法属玻利尼西亚"},
{"classname":"foldtopname16","foldname":"Portugal葡萄牙"},
{"classname":"foldtopname16","foldname":"PuertoRico波多黎各"},
{"classname":"foldtopname17","foldname":"Qatar卡塔尔"},
{"classname":"foldtopname18","foldname":"Reunion留尼旺"},
{"classname":"foldtopname18","foldname":"Romania罗马尼亚"},
{"classname":"foldtopname18","foldname":"Russia俄罗斯"},
{"classname":"foldtopname19","foldname":"SaintLueia圣卢西亚"},
{"classname":"foldtopname19","foldname":"SaintVincent圣文森特岛"},
{"classname":"foldtopname19","foldname":"SamoaEastern东萨摩亚(美)"},
{"classname":"foldtopname19","foldname":"SamoaWestern西萨摩亚"},
{"classname":"foldtopname19","foldname":"SanMarino圣马力诺"},
{"classname":"foldtopname19","foldname":"SaoTomeandPrincipe圣多美和普林西比"},
{"classname":"foldtopname19","foldname":"SaudiArabia沙特阿拉伯"},
{"classname":"foldtopname19","foldname":"Senegal塞内加尔"},
{"classname":"foldtopname19","foldname":"Seychelles塞舌尔"},
{"classname":"foldtopname19","foldname":"SierraLeone塞拉利昂"},
{"classname":"foldtopname19","foldname":"Singapore新加坡"},
{"classname":"foldtopname19","foldname":"Slovakia斯洛伐克"},
{"classname":"foldtopname19","foldname":"Slovenia斯洛文尼亚"},
{"classname":"foldtopname19","foldname":"SolomonIs所罗门群岛"},
{"classname":"foldtopname19","foldname":"Somali索马里"},
{"classname":"foldtopname19","foldname":"SouthAfrica南非"},
{"classname":"foldtopname19","foldname":"Spain西班牙"},
{"classname":"foldtopname19","foldname":"SriLanka斯里兰卡"},
{"classname":"foldtopname19","foldname":"St.Lucia圣卢西亚"},
{"classname":"foldtopname19","foldname":"St.Vincent圣文森特"},
{"classname":"foldtopname19","foldname":"Sudan苏丹"},
{"classname":"foldtopname19","foldname":"Suriname苏里南"},
{"classname":"foldtopname19","foldname":"Swaziland斯威士兰"},
{"classname":"foldtopname19","foldname":"Sweden瑞典"},
{"classname":"foldtopname19","foldname":"Switzerland瑞士"},
{"classname":"foldtopname19","foldname":"Syria叙利亚"},
{"classname":"foldtopname20","foldname":"Taiwan台湾省"},
{"classname":"foldtopname20","foldname":"Tajikstan塔吉克斯坦"},
{"classname":"foldtopname20","foldname":"Tanzania坦桑尼亚"},
{"classname":"foldtopname20","foldname":"Thailand泰国"},
{"classname":"foldtopname20","foldname":"Togo多哥"},
{"classname":"foldtopname20","foldname":"Tonga汤加"},
{"classname":"foldtopname20","foldname":"TrinidadandTobago特立尼达和多巴哥"},
{"classname":"foldtopname20","foldname":"Tunisia突尼斯"},
{"classname":"foldtopname20","foldname":"Turkey土耳其"},
{"classname":"foldtopname20","foldname":"Turkmenistan土库曼斯坦"},
{"classname":"foldtopname21","foldname":"Uganda乌干达"},
{"classname":"foldtopname21","foldname":"Ukraine乌克兰"},
{"classname":"foldtopname21","foldname":"UnitedArabEmirates阿拉伯联合酋长国"},
{"classname":"foldtopname21","foldname":"UnitedKiongdom英国"},
{"classname":"foldtopname21","foldname":"UnitedStatesofAmerica美国"},
{"classname":"foldtopname21","foldname":"Uruguay乌拉圭"},
{"classname":"foldtopname21","foldname":"Uzbekistan乌兹别克斯坦"},
{"classname":"foldtopname22","foldname":"Venezuela委内瑞拉"},
{"classname":"foldtopname22","foldname":"Vietnam越南"},
{"classname":"foldtopname25","foldname":"Yemen也门"},
{"classname":"foldtopname25","foldname":"Yugoslavia南斯拉夫"},
{"classname":"foldtopname26","foldname":"Zimbabwe津巴布韦"},
{"classname":"foldtopname26","foldname":"Zaire扎伊尔"},
{"classname":"foldtopname26","foldname":"Zambia赞比亚"}
];
var allfoldNamelen = allfoldName.length;
  $('.index_item_c,.detail_pop_collection').click(function(event){
    $('body').append(collectionhtml);
    for (var i = 0; i < allfoldNamelen; i++) {
      var allfoldHtml = '<li class="pop_col_colum_on clearfix '+allfoldName[i].classname+'">\
                      <div class="pop_col_colava">\
                        <a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>\
                      </div>\
                      <div class="pop_col_colname"><a href="javascript:;" target="_blank" title="'+allfoldName[i].foldname+'">'+allfoldName[i].foldname+'</a></div>\
                      <a class="pop_col_foldlock"></a>\
                      <a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>\
                    </li>';
      $('.pop_col_colum_all').append(allfoldHtml)
      event.stopPropagation();
    };
    var popH =$('#allcollect').find('.pop_con').height();
    $('#allcollect').find('.pop_col_left').height(popH-40);
    $('#allcollect,.pop_close').click(function(){
      $('.pop_col_colum_wrap').animate({scrollTop: 0},0);
      $('#allcollect').remove();
    })
    $('#allcollect .pop_con').click(function(){
      event.stopPropagation()
    })
    var popconHei = $('#allcollect .pop_con').height();
    $('.pop_con').css({
       'margin-top':-(popconHei/2)
    });
    $('.pop_col_sinput').keyup(function(){
      var obj = $(this);
      var kw = jQuery.trim(obj.val());
      if(kw == ""){
          $("#append").html("");
          return false;
      }
      var html = "";
      for (var i = 0; i < allfoldName.length; i++) {
          if (allfoldName[i].foldname.indexOf(kw) >= 0) {
              html = html + "<div class='item' style='padding:10px 0px;font-size:12px;line-height:16px;'>" + allfoldName[i].foldname + "</div>"
          }
      }
      if(html != ""){
        var searchappendhtml = '<div class="pop_col_searfold_wrap" id="append">'+html+'</div>';
        $('.pop_col_sinput_wrap').append(searchappendhtml);
      }else{
          
      }
      $('.item').click(function(event) {
        $('.pop_col_sinput').val($(this).text())
      });
    })
    $('.pop_con').click(function(){
      $(".pop_col_searfold_wrap").remove();
    })
    $('.pop_col_searfold_wrap').click(function(){
      event.stopPropagation();
    })
    $('.pop_col_alpbtn').click(function(){
      if ($(this).hasClass('point_to_1')) {
        $('.pop_col_colum_wrap').animate({scrollTop: 203},300);
      };
      if ($(this).hasClass('point_to_2')) {
        var foldclasslen = $('.foldtopname1').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_3')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_4')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_5')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_6')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_7')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_8')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length + $('.foldtopname7').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_9')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length + $('.foldtopname7').length + $('.foldtopname8').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_10')) {
        var foldclasslen =  $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length + $('.foldtopname7').length + $('.foldtopname8').length + $('.foldtopname9').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
        console.info(1)
      };
      if ($(this).hasClass('point_to_11')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length + $('.foldtopname7').length + $('.foldtopname8').length + $('.foldtopname9').length + $('.foldtopname10').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
        console.info(2)
      };
      if ($(this).hasClass('point_to_12')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length + $('.foldtopname7').length + $('.foldtopname8').length + $('.foldtopname9').length + $('.foldtopname10').length + $('.foldtopname11').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_13')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length + $('.foldtopname7').length + $('.foldtopname8').length + $('.foldtopname9').length + $('.foldtopname10').length + $('.foldtopname11').length + $('.foldtopname12').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_14')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length + $('.foldtopname7').length + $('.foldtopname8').length + $('.foldtopname9').length + $('.foldtopname10').length + $('.foldtopname11').length + $('.foldtopname12').length + $('.foldtopname13').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_15')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length + $('.foldtopname7').length + $('.foldtopname8').length + $('.foldtopname9').length + $('.foldtopname10').length + $('.foldtopname11').length + $('.foldtopname12').length + $('.foldtopname13').length + $('.foldtopname14').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_16')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length + $('.foldtopname7').length + $('.foldtopname8').length + $('.foldtopname9').length + $('.foldtopname10').length + $('.foldtopname11').length + $('.foldtopname12').length + $('.foldtopname13').length + $('.foldtopname14').length + $('.foldtopname15').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_17')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length + $('.foldtopname7').length + $('.foldtopname8').length + $('.foldtopname9').length + $('.foldtopname10').length + $('.foldtopname11').length + $('.foldtopname12').length + $('.foldtopname13').length + $('.foldtopname14').length  + $('.foldtopname15').length + $('.foldtopname16').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_18')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length + $('.foldtopname7').length + $('.foldtopname8').length + $('.foldtopname9').length + $('.foldtopname10').length + $('.foldtopname11').length + $('.foldtopname12').length + $('.foldtopname13').length + $('.foldtopname14').length + $('.foldtopname15').length + $('.foldtopname16').length + $('.foldtopname17').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_19')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length + $('.foldtopname7').length + $('.foldtopname8').length + $('.foldtopname9').length + $('.foldtopname10').length + $('.foldtopname11').length + $('.foldtopname12').length + $('.foldtopname13').length + $('.foldtopname14').length + $('.foldtopname15').length + $('.foldtopname16').length + $('.foldtopname17').length + $('.foldtopname18').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_20')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length + $('.foldtopname7').length + $('.foldtopname8').length + $('.foldtopname9').length + $('.foldtopname10').length + $('.foldtopname11').length + $('.foldtopname12').length + $('.foldtopname13').length + $('.foldtopname14').length + $('.foldtopname15').length + $('.foldtopname16').length + $('.foldtopname17').length + $('.foldtopname18').length + $('.foldtopname19').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_21')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length + $('.foldtopname7').length + $('.foldtopname8').length + $('.foldtopname9').length + $('.foldtopname10').length + $('.foldtopname11').length + $('.foldtopname12').length + $('.foldtopname13').length + $('.foldtopname14').length + $('.foldtopname15').length + $('.foldtopname16').length + $('.foldtopname17').length + $('.foldtopname18').length + $('.foldtopname19').length + $('.foldtopname20').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_22')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length + $('.foldtopname7').length + $('.foldtopname8').length + $('.foldtopname9').length + $('.foldtopname10').length + $('.foldtopname11').length + $('.foldtopname12').length + $('.foldtopname13').length + $('.foldtopname14').length + $('.foldtopname15').length + $('.foldtopname16').length + $('.foldtopname17').length + $('.foldtopname18').length + $('.foldtopname19').length + $('.foldtopname20').length + $('.foldtopname21').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_23')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length + $('.foldtopname7').length + $('.foldtopname8').length + $('.foldtopname9').length + $('.foldtopname10').length + $('.foldtopname11').length + $('.foldtopname12').length + $('.foldtopname13').length + $('.foldtopname14').length + $('.foldtopname15').length + $('.foldtopname16').length + $('.foldtopname17').length + $('.foldtopname18').length + $('.foldtopname19').length + $('.foldtopname20').length + $('.foldtopname21').length + $('.foldtopname22').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_24')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length + $('.foldtopname7').length + $('.foldtopname8').length + $('.foldtopname9').length + $('.foldtopname10').length + $('.foldtopname11').length + $('.foldtopname12').length + $('.foldtopname13').length + $('.foldtopname14').length + $('.foldtopname15').length + $('.foldtopname16').length + $('.foldtopname17').length + $('.foldtopname18').length + $('.foldtopname19').length + $('.foldtopname20').length + $('.foldtopname21').length + $('.foldtopname22').length + $('.foldtopname23').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_25')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length + $('.foldtopname7').length + $('.foldtopname8').length + $('.foldtopname9').length + $('.foldtopname10').length + $('.foldtopname11').length + $('.foldtopname12').length + $('.foldtopname13').length + $('.foldtopname14').length + $('.foldtopname15').length + $('.foldtopname16').length + $('.foldtopname17').length + $('.foldtopname18').length + $('.foldtopname19').length + $('.foldtopname20').length + $('.foldtopname21').length + $('.foldtopname22').length + $('.foldtopname23').length + $('.foldtopname24').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
      if ($(this).hasClass('point_to_26')) {
        var foldclasslen = $('.foldtopname1').length + $('.foldtopname2').length + $('.foldtopname3').length + $('.foldtopname4').length + $('.foldtopname5').length + $('.foldtopname6').length + $('.foldtopname7').length + $('.foldtopname8').length + $('.foldtopname9').length + $('.foldtopname10').length + $('.foldtopname11').length + $('.foldtopname12').length + $('.foldtopname13').length + $('.foldtopname14').length + $('.foldtopname15').length + $('.foldtopname16').length + $('.foldtopname17').length + $('.foldtopname18').length + $('.foldtopname19').length + $('.foldtopname20').length + $('.foldtopname21').length + $('.foldtopname22').length + $('.foldtopname23').length + $('.foldtopname24').length + $('.foldtopname25').length;
        var relfoldclasslen = foldclasslen/3;
        $('.pop_col_colum_wrap').animate({scrollTop: relfoldclasslen*43+203},300);
      };
    })
    // for (var i = 1; i <= 26; i++) {
    //   var clickClass = "point_to_"+i;
    //   $("."+clickClass+"").click(function(){
    //     alert($(this).attr('class'))
    //     var scrollClass = "foldtopname"+i;
    //     var foldnamescrolen = allfoldName[i].classname.length;
    //     alert(foldnamescrolen);
    //   })
    // };
  })
   // htmlv?=20160710
   
   // htmlv?=20160716
  var uploadPophtml = '<div class="pop_addpic_multi">\
    <div class="pop_con">\
      <p class="pop_tit">\
        上传图片\
        <span class="pop_close"></span>\
      </p>\
      <div class="pop_namewrap clearfix" style="padding:0px 0px 0px 30px;">\
        <span class="pop_labelname" style="font-size:12px;line-height:42px;width:100%;">图片展示</span>\
        <div class="pop_addpic_con clearfix" style="float:left">\
          <span class="pop_pic_wrap"></span>\
            <div class="pop_addpic_wrap" id="pop_addpic_multibtn" style="position:relative;float:left;">\
              <img src="public/images/pop_upload_multi.jpg" alt=""/>\
              <input type="file"/>\
            </div>\
        </div>\
      </div>\
      <div class="pop_namewrap clearfix" style="padding:8px 0px 8px 30px;">\
        <span class="pop_labelname" style="font-size:12px;line-height:36px;">文件夹</span>\
        <select class="pop_iptselect">\
          <option value="">椅子</option>\
          <option value="">桌子</option>\
          <option value="">电视柜</option>\
          <option value="">沙发</option>\
          <option value="">卧室</option>\
          <option value="">卫生间</option>\
        </select>\
      </div>\
      <div class="pop_btnwrap">\
        <div class="pop_col_lbtm" style="color:#000;position:relative;float:left;">\
          <span class="pop_col_lbshare">分享到 :</span>&nbsp;\
          <span class="pop_col_bwrap">\
            <a href="javascript:;" class="pop_col_r pop_col_radio_on"></a>\
            <a class="pop_col_lbswc"></a>\
            <a class="jiathis_button_weixin jiathis_button jiathis_button_on"></a>\
          </span>\
          <span class="pop_col_lbshare">微信朋友圈</span>&nbsp;\
          <span class="pop_col_bwrap">\
            <a href="javascript:;" class="pop_col_r pop_col_radio" style="border:4px solid #d9d9d9;background:#fff;"></a>\
            <a class="pop_col_lbsqq"></a>\
            <a class="jiathis_button_qzone jiathis_button"></a>\
          </span>\
          <span class="pop_col_lbshare">QQ空间</span>\
          <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>\
        </div>\
        <a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>\
        <a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding">上传</a>\
      </div>\
    </div>\
  </div>'
  $('.header_more_a1,.pop_cona').click(function(){
    $('.pop_goodsupload').hide();
    $('body').append(uploadPophtml);
    var poptopHei = $('.pop_addpic_multi .pop_con').height();
    $('.pop_addpic_multi .pop_con').css({
       'margin-top':-(poptopHei/2)
    });
    
    $('.pop_addpic_wrap input').change(function(){
        var imgcon = $('.pop_pic_wrap');
        if (this.files && this.files[0]) {
          var filename = this.files[0].name;
          var subfile = filename.split('.');
          var subfilelen = subfile.length;
          var last = subfile[subfilelen-1].toLowerCase();
          var tp ="jpg,gif,bmp,png,jpeg";
          var rs=tp.indexOf(last);
            if(rs>=0){
              // htmlv?=20160720
              var reader = new FileReader();
              reader.onload = function(evt){
                var addpicLen = $('.pop_pic_wrap .pop_addpic_wrap').length;
                var appendnewNode = '<div class="pop_addpic_wrap" style="position:relative;">\
                              <span class="close_img_btn">×</span>\
                              <img src="'+evt.target.result+'" alt="">\
                              <textarea class="pop_addfont_wrap">'+subfile[0]+'</textarea>\
                            </div>';
              // htmlv?=20160720
                if (addpicLen == 4) {
                  $('.pop_pic_wrap').append(appendnewNode);
                  $('#pop_addpic_multibtn').hide()
                  // alert(addpicLen)
                }else{
                  $('.pop_pic_wrap').append(appendnewNode);
                  $('#pop_addpic_multibtn').show()
                };
                $('.close_img_btn').click(function(){
                  var addpicLen = $('.pop_pic_wrap .pop_addpic_wrap').length;
                  $(this).parents('.pop_addpic_wrap').remove();
                  if (addpicLen == 5) {
                      $('#pop_addpic_multibtn').show();
                    }
                });
                // htmlv?=20160720
                $('.pop_addfont_wrap').each(function(){
                  var popaddfontHei = $(this).height()-2;
                  if (popaddfontHei >= 14) {
                    var addpopbottom = popaddfontHei - 14;
                    $(this).css({height:'14px'});
                    // $(this).hover(function() {
                    //   $(this).animate({height:popaddfontHei}, "normal")
                    // }, function() {
                    //   $(this).animate({height:'14px'}, "normal")
                    // });
                    $(this).focusin(function(){
                      $(this).animate({height:popaddfontHei}, "normal")
                    });
                    $(this).focusout(function(){
                      $(this).animate({height:'14px'}, "normal")
                    })
                  }else{
                    $(this).css({bottom:0});
                  };
                });
                // htmlv?=20160720
                // $('.pop_addfont_wrap').hover(function() {
                //   $(this).css({height:'auto'});
                // }, function() {
                //   $(this).css({bottom:'0px'});
                // }); 
                // $('.pop_addfont_wrap').click(function(){
                //   var oldname = filename;
                //   $(this).html('');
                //   var textareaHtml = '<textarea name="" id="" cols="30" rows="10">'+oldname+'</textarea>';
                //   $(this).append(textareaHtml)
                // })
              }
              reader.readAsDataURL(this.files[0]);
          }else{
              alert("您选择的上传文件不是有效的图片文件！请重新选择");
              return false;
          }
        } else{
        };

      });
    $('.pop_addpic_multi,.pop_close,.detail_pop_cancel').click(function(){
        $('.pop_addpic_multi').remove();
      })
      $('.pop_addpic_multi .pop_con').click(function(){
        event.stopPropagation()
      }) 
  })
// // htmlv?=20160716
// var informHtml = '<div class="header_moremess">\
//           <div class="header_add_up"></div>\
//           <div class="header_add_clickbtn clearfix">\
//             <a href="javascript:;" class="header_add_clicka header_add_clicka_on" style="border-radius: 6px 0px 0px 0px">通知</a>\
//             <a href="javascript:;" class="header_add_clicka" style="border: none;border-radius:0px 6px 0px 0px">消息</a>\
//           </div>\
//           <div class="header_add_con">\
//             <ul class="header_add_cul">\
//               <div class="pop_info_four clearfix">\
//                 <img src="public/images/pop_info_bg.png" height="49" width="49" alt="">\
//                 <div class="pop_info_fcontent">\
//                   <p>系统通知 - <span>1个月前</span></p>\
//                   <p>室内软装设计大赛，室内软装设计大赛在普陀区怒江北路…</p>\
//                 </div>\
//                 <a href="javascript:;" class="pop_info_clickbtn"><img src="public/images/pop_info_to.png" height="29" width="17" alt=""></a>\
//               </div>\
//               <div class="pop_info_four clearfix">\
//                 <img src="public/images/pop_info_bg.png" height="49" width="49" alt="">\
//                 <div class="pop_info_fcontent">\
//                   <p>系统通知 - <span>1个月前</span></p>\
//                   <p>室内软装设计大赛，室内软装设计大赛在普陀区怒江北路…</p>\
//                 </div>\
//                  <a href="javascript:;" class="pop_info_clickbtn"><img src="public/images/pop_info_to.png" height="29" width="17" alt=""></a>\
//               </div>\
//               <div class="pop_info_four clearfix">\
//                 <img src="public/images/pop_info_bg.png" height="49" width="49" alt="">\
//                 <div class="pop_info_fcontent">\
//                   <p>系统通知 - <span>1个月前</span></p>\
//                   <p>室内软装设计大赛，室内软装设计大赛在普陀区怒江北路…</p>\
//                 </div>\
//                  <a href="javascript:;" class="pop_info_clickbtn"><img src="public/images/pop_info_to.png" height="29" width="17" alt=""></a>\
//               </div>\
//               <div class="pop_info_four clearfix">\
//                 <img src="public/images/pop_info_bg.png" height="49" width="49" alt="">\
//                 <div class="pop_info_fcontent">\
//                   <p>系统通知 - <span>1个月前</span></p>\
//                   <p>室内软装设计大赛，室内软装设计大赛在普陀区怒江北路…</p>\
//                 </div>\
//                  <a href="javascript:;" class="pop_info_clickbtn"><img src="public/images/pop_info_to.png" height="29" width="17" alt=""></a>\
//               </div>\
//             </ul>\
//             <ul class="header_add_cul">\
//               <li class="clearfix">\
//                 <div class="header_add_mava_wrap">\
//                   <img src="public/images/temp_avatar.JPG" alt="">\
//                 </div>\
//                 <div class="header_add_font_wrap">\
//                   <p class="header_add_font_a">小周 - <span>1个月前</span></p>\
//                   <p class="header_add_font_a">关注了你</p>\
//                 </div>\
//                 <div class="header_add_fold_wrap">\
//                   <img src="public/images/temp/temp (1).png" height="127" width="127" alt=""> \
//                 </div>\
//               </li>\
//               <li class="clearfix">\
//                 <div class="header_add_mava_wrap">\
//                   <img src="public/images/temp_avatar.JPG" alt="">\
//                 </div>\
//                 <div class="header_add_font_wrap">\
//                   <p class="header_add_font_a">小周 - <span>1个月前</span></p>\
//                   <p class="header_add_font_a">关注了你的文件夹</p>\
//                 </div>\
//                 <div class="header_add_fold_wrap">\
//                   <img src="public/images/temp/temp (1).png" height="127" width="127" alt=""> \
//                 </div>\
//               </li>\
//               <li class="clearfix">\
//                 <div class="header_add_mava_wrap">\
//                   <img src="public/images/temp_avatar.JPG" alt="">\
//                 </div>\
//                 <div class="header_add_font_wrap">\
//                   <p class="header_add_font_a">小周 - <span>1个月前</span></p>\
//                   <p class="header_add_font_a">关注了你的文件夹</p>\
//                 </div>\
//                 <div class="header_add_fold_wrap">\
//                   <img src="public/images/temp/temp (1).png" height="127" width="127" alt="">\
//                 </div>\
//               </li>\
//               <li class="clearfix">\
//                 <div class="header_add_mava_wrap">\
//                   <img src="public/images/temp_avatar.JPG" alt="">\
//                 </div>\
//                 <div class="header_add_font_wrap">\
//                   <p class="header_add_font_a">小周 - <span>1个月前</span></p>\
//                   <p class="header_add_font_a">关注了你的文件夹</p>\
//                 </div>\
//                 <div class="header_add_fold_wrap">\
//                   <img src="public/images/temp/temp (1).png" height="127" width="127" alt="">\
//                 </div>\
//               </li>\
//             </ul>\
//           </div>\
//           <a href="javascript:;" class="header_add_more">查看更多</a>\
//         </div>';
//         var privacyHtml = '<div class="pop_detail_con">\
//           <div class="pop_detail_each">\
//             <p class="pop_detail_eachtit">\
//               天宇大赛\
//             </p>\
//             <div class="pop_detail_eachcon">\
//               <p>天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛天宇大赛</p>\
//               <img src="public/images/pop_temp.jpg" alt="">\
//             </div>\
//             <p class="pop_detail_eachfrom">\
//               管理员发送于4小时前\
//             </p>\
//           </div>\
//         </div>';
//         $('.header_mess').hover(function() {
//           $('.header_mess').append(informHtml);
//           var messindex = 0;
//           $('.header_add_cul').eq(messindex).show()
//           $('.header_add_clicka').click(function(){
//             messindex = $(this).index();
//             $('.header_add_clicka').removeClass('header_add_clicka_on');
//             $(this).addClass('header_add_clicka_on');
//             $('.header_add_cul').hide();
//             $('.header_add_cul').eq(messindex).show();
//             $('.pop_detail_con').remove();
//             $('.pop_info_four').show();
//           });
//           $('.pop_info_clickbtn').click(function(){
//               $('.pop_info_four').hide()
//               $('.header_add_cul').append(privacyHtml)
//             })
//         }, function() {
//           $('.header_moremess').remove();
//         });

//       // <!-- htmlv?=20160718 -->

// }

//     