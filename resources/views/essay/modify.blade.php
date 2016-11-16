<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>堆图家-发现全部</title>
	<link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/news/font-awesome.min.css">
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="public/css/font-awesome-ie7.min.css">
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/news/main.css">
	<link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/news/index.css">
	<script type="text/javascript" src="{{asset('web')}}/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/static/layer/layer.js"></script>
	
	<script type="text/javascript" src="{{asset('web')}}/plugins/Masonry/masonry-docs.min.js"></script>
	<script type="text/javascript" src="{{asset('web')}}/js/news/index.js"></script>
	  <script type="text/javascript" charset="utf-8" src="{{asset('web')}}/plugins/uedit/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('web')}}/plugins/uedit/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="{{asset('web')}}/plugins/uedit/lang/zh-cn/zh-cn.js"></script>
</head>
<body style="background: #fff;padding-bottom: 100px;">
<form id="form1" method="post" action="/Article/mod/mod" enctype= "multipart/form-data">
<div class="w944 edit">
		<div class="edit-btns clearfix">
			<button onclick="clearLocalData ()" class="btn">清空草稿</button>
			<!-- <a href="#" class="btn right">上传</a> -->
			<!-- <button onclick="getContent()" class="btn right">保存</button> -->
			<input type="submit" class="btn right" value="提交">
			<input type="hidden" name="eassat_id" value="<?php echo $eassat_id ?>">

		</div>
		
<div> 
 <div><h1>自适应边框</h1>
			<label class="switch-btn">
			                <input class="checked-switch" type="checkbox" name="adapt" value="1" />
			                <span class="text-switch" data-yes="适应" data-no="no"></span> 
			                <span class="toggle-btn"></span> 
			</label>
		</div>
    
     <script id="editor" type="text/plain" name="cont" style="width:944px;height:500px;">
     <?php echo $eassat_cont ?>
  </script>

		
		
		<div class="edit-tiem">
			<div class="edit-tit">文章描述</div>
			<div class="edit-con ec-info">
				<textarea name="eassat_describe" id="describe" rows="" cols=""> <?php echo $eassat_describe ?></textarea>
			</div>
		</div>
		<div class="edit-tiem">
			<div class="edit-tit">文章标题</div>
			<div class="edit-con ec-info">
				<input type="text"  class="artcle-title" id="title" name="eassat_title" placeholder="大标签(文章名)" value="<?php echo $eassat_title ?>" />
			</div>
		</div>
		<div class="edit-tiem">
			<div class="edit-tit">文章指导</div>
			<div class="edit-con ec-info">
				<div class="vr_line">
					
					
						<div class="select hourse-type">
						<label data-val="1"><i></i>设计师</label>
						
						<label data-val="2"><i></i>商家</label>
						
						<label data-val="3"><i></i>家居迷</label>
						
						<input type="hidden" name="select"/>
						

						

						</div>
					
				</div>
			</div>
			<div class="edit-con ec-info">
				<input type="text" name="eassat_user"  class="artcle-title"  placeholder="用户名"/>			
			</div>
		</div>
		<div class="edit-tiem">
			<div class="edit-tit">分类标签</div>
			<div class="edit-con ec-info">
				<select name="classfy1" id="classfy1">
					
					<option value="">品牌故事</option>
					<option value="国际品牌;品牌故事">国际品牌</option>
					<option value="设计师品牌;品牌故事">设计师品牌</option>
					<option value="卫浴品牌;品牌故事">卫浴品牌</option>
					<option value="瓷砖品牌;品牌故事">瓷砖品牌</option>
					<option value="家具品牌;品牌故事">家具品牌</option>
					<option value="饰品品牌;品牌故事">饰品品牌</option>
					<option value="布艺品牌;品牌故事">布艺品牌</option>
					<option value="板材品牌;品牌故事">板材品牌</option>
					<option value="其他">其他</option>
				</select>
				<select name="classfy2" id="classfy2">
				
					<option value="">问答社区</option>
					<option value="水电;问答社区">水电</option>
					<option value="木工;问答社区">木工</option>
					<option value="泥瓦;问答社区">泥瓦</option>
					<option value="厨房;问答社区">厨房</option>
					<option value="客厅;问答社区">客厅</option>
					<option value="卫浴;问答社区">卫浴</option>
					<option value="卧室;问答社区">卧室</option>
					<option value="儿童房;问答社区">儿童房</option>
					<option value="书房;问答社区">书房</option>
					<option value="餐厅;问答社区">餐厅</option>
					<option value="阳台;问答社区">阳台</option>
					<option value="玄关;问答社区">玄关</option>
					<option value="其他;问答社区">其他</option>
				</select>
				<select name="classfy3" id="classfy3">
					<option value="">家居知识</option>
					<option value="水电;家具知识">水电</option>
					<option value="木工;家具知识">木工</option>
					<option value="泥瓦;家具知识">泥瓦</option>
					<option value="厨房;家具知识">厨房</option>
					<option value="客厅;家具知识">客厅</option>
					<option value="卫浴;家具知识">卫浴</option>
					<option value="卧室;家具知识">卧室</option>
					<option value="儿童房;家具知识">儿童房</option>
					<option value="书房;家具知识">书房</option>
					<option value="餐厅;家具知识">餐厅</option>
					<option value="阳台;家具知识">阳台</option>
					<option value="玄关;家具知识">玄关</option>
					<option value="其他;家具知识">其他</option>
				</select>
				<select name="classfy4" id="classfy4" >
					<option value="">设计师</option>
					<option value="不限;设计师">不限</option>
					<option value="家居住宅;设计师">家居住宅</option>
					<option value="别墅豪宅;设计师">别墅豪宅</option>
					<option value="办公室;设计师">办公室</option>
					<option value="酒店;设计师">酒店</option>
					<option value="餐厅;设计师">餐厅</option>
					<option value="咖啡厅;设计师">咖啡厅</option>
					<option value="酒吧KTV;设计师">酒吧KTV</option>
					<option value="商品展示;设计师">商品展示</option>
					<option value="医院;设计师">医院</option>
					<option value="幼儿园;设计师">幼儿园</option>
					<option value="会所;设计师">会所</option>
					<option value="样板房;设计师">样板房</option>
					<option value="售楼处;设计师">售楼处</option>
					<option value="文化空间;设计师">文化空间</option>
					<option value="运动空间;设计师">运动空间</option>
				</select>
				<select name="classfy11" id="classfy11" >
					<option value="">摆件</option>
					<option value="镜子;摆件">镜子</option>
					<option value="钟;摆件">钟</option>
					<option value="装置画;摆件">装置画</option>
					<option value="香薰;摆件">香薰</option>
					<option value="挂钩;摆件">挂钩</option>
					<option value="收纳;摆件">收纳</option>
					<option value="相框;摆件">相框</option>
				</select>
				<select name="classfy12" id="classfy12" >
					<option value="">色系</option>
					<option value="红;色系">红</option>
					<option value="橙;色系">橙</option>
					<option value="黄;色系">黄</option>
					<option value="绿;色系">绿</option>
					<option value="青;色系">青</option>
					<option value="蓝;色系">蓝</option>
					<option value="紫;色系">紫</option>
					<option value="黑;色系">黑</option>
					<option value="白;色系">白</option>
					<option value="灰;色系">灰</option>
				</select>
				
			</div>
			<div class="edit-con ec-info">
				<select name="classfy5" id="classfy5">
					<option value="">软装</option>
					<option value="沙发;软装">沙发</option>
					<option value="床;软装">床</option>
					<option value="窗帘;软装">窗帘</option>
					<option value="床品;软装">床品</option>
					<option value="桌子;软装">桌子</option>
					<option value="椅子;软装">椅子</option>
					<option value="装饰摆件;软装">装饰摆件</option>
					<option value="植物;软装">植物</option>
				</select>
				<select name="classfy6" id="classfy6">
					<option value="">灯</option>
					<option value="吊灯;灯">吊灯</option>
					<option value="落地灯;灯">落地灯</option>
					<option value="台灯;灯">台灯</option>
					<option value="壁灯;灯">壁灯</option>
					<option value="射灯;灯">射灯</option>
				</select>
				<select name="classfy7"  id="classfy7">
					<option value="">风格</option>
					<option value="现代;风格">现代</option>
					<option value="北欧;风格">北欧</option>
					<option value="日式;风格">日式</option>
					<option value="法式;风格">法式</option>
					<option value="新中式;风格">新中式</option>
					<option value="新古典;风格">新古典</option>
					<option value="简欧;风格">简欧</option>
					<option value="古典中式;风格">古典中式</option>
					<option value="古典;风格">古典</option>
					<option value="地中海;风格">地中海</option>
					<option value="LOFT;风格">LOFT</option>
					<option value="东南亚;风格">东南亚</option>
					<option value="工业;风格">工业</option>
					<option value="田园;风格">田园</option>
					<option value="美式简约;风格">美式简约</option>
					<option value="巴洛克;风格">巴洛克</option>
					<option value="意大利;风格">意大利</option>
					<option value="混搭;风格">混搭</option>
				</select>
				<select name="classfy8" id="classfy8" >
					<option value="">空间</option>
					<option value="客厅;空间">客厅</option>
					<option value="卧室;空间;空间">卧室</option>
					<option value="厨房;空间">厨房</option>
					<option value="餐厅;空间">餐厅</option>
					<option value="阳台;空间">阳台</option>
					<option value="书房;空间">书房</option>
					<option value="玄关;空间">玄关</option>
					<option value="卫生间;空间">卫生间</option>
					<option value="儿童房;空间">儿童房</option>
				</select>
				<select name="classfy9" id="classfy9" >
					<option value="">局部</option>
					<option value="收纳;局部">收纳</option>
					<option value="飘窗;局部">飘窗</option>
					<option value="搁板;局部">搁板</option>
					<option value="床头;局部">床头</option>
					<option value="照片墙;局部">照片墙</option>
					<option value="榻榻米;局部">榻榻米</option>
					<option value="电视背景墙;局部">电视背景墙</option>
				</select>
				<select name="classfy10" id="classfy10">
					<option value="">硬装</option>
					<option value="墙;硬装">墙</option>
					<option value="地面;硬装">地面</option>
					<option value="门;硬装">门</option>
					<option value="窗;硬装">窗</option>
				</select>
			</div>
		</div>
		<div class="edit-tiem">
			<div class="edit-tit">推荐文章展示大图（含文案）（长高比750:350）</div>
			<div class="edit-con ec-info clearfix">
				<div class="pic-show-box pop_pic_wrap">
				</div>
				<div class="pic-show-btns ">
					<p><a  class="upload_img">上传<input type="file" name="file1"  class="f1"  /></a></p>
					<p><a  class="change_img">更换<input type="file" class="f2" name="file2"   /></a></p>
					<p><a  class="delete_img">删除</a></p>
				</div>
			</div>
		</div>
		<div class="edit-tiem">
		
			<div class="edit-tit">九宫格展示图（长高比390:245）</div>
			<div class="edit-con ec-info clearfix">
				<div class="pic-show-box pic-show-box2">
				</div>
				<div class="pic-show-btns">
					<p><a  class="upload_img">上传<input type="file" name="file3"  class="f1"  /></a></p>
					<p><a  class="change_img">更换<input type="file" class="f2" name="file4"   /></a></p>
					<p><a  class="delete_img">删除</a></p>
				</div>
			</div>				
		</div>
		<div>是否推广
			<label class="switch-btn">
			                <input class="checked-switch" type="checkbox" name="where" value="1" />
			                <span class="text-switch" data-yes="yes" data-no="no"></span> 
			                <span class="toggle-btn"></span> 
			</label>
		</div>
<script type="text/javascript">
//	图片上传
	 $('.pic-show-btns input').change(function(){
	 	var btnname=$(this)[0].className;	 	
        var imgcon =$(this).parents('.pic-show-btns').siblings('.pic-show-box');

        var ss=imgcon.html();

		var i=ss.indexOf('img')  
		
		if(i>0&&btnname=='f1'){
			alert('你已经上传了图片，请点击修改按钮进行修改');
			return;
		}
	
		
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
                var appendnewNode = '<img src="'+evt.target.result+'" alt="">';
                  $(imgcon).html(appendnewNode);
              }
              reader.readAsDataURL(this.files[0]);
          }else{
              alert("您选择的上传文件不是有效的图片文件！请重新选择");
              return false;
          }
        } else{
        };

      });
      $('.delete_img').click(function(){
      	$(this).parents('.pic-show-btns').siblings('.pic-show-box').html('');
      })      
</script>
<script src="{{asset('web')}}/js/news/eassat.js"></script>
<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例 
    $('.select label').click(function(){
			if(!$(this).hasClass('on')){
				$(this).addClass('on').siblings().removeClass('on');
				$(this).siblings('input').val($(this).attr('data-val'));
			}
		})
</script>
</form>
</body>
</html>
