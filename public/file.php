 
<html> 
<head> 
<title>input file赋初值--Test by 编程浪子</title> 
<script src="js/jquery.js"></script>
<script src="js/ajaxfileupload.js"></script>
<script src="js/jquery.form.js"></script>
</script>
<head> 
<body> 


<form action="ufile.php" method="post" enctype="multipart/form-data" name='ua'>
    <div class="pop_con">
      <p class="pop_tit">
        上传图片
        <span class="pop_close"></span>
      </p>
      <div class="pop_upload_wrap">
        <a class="pop_upload_a">
          <input class="pop_upload" type="file" name='image'></input>
          <input type="hidden" name='fid' value="10"></input>
          <input type="hidden" name='title' value="来自相册"></input>
          <input type="hidden" name='kind' value="2"></input>
          <input type="hidden" name='user_id' value=""></input>
          <span>请选择文件</span>
        </a>
        <!-- <a href="javascript:;" id='ua' class="pop_buildbtn detail_filebtn detail_filebtn_cpadding">上传</a> -->
        <input type="submit" value="上传"></input>
      </div>
    </div>
    </form>
<script type="text/javascript">
    /*$('form[name=ua]').submit(function(){
      ua = $('form[name=ua]').serialize()
      $(this).ajaxSubmit({
        type:"post",  //提交方式
        dataType:"json", //数据类型
        'fileTypeDesc': "Image Files",
        url:"ufile.php", //请求url
        success:function(json){ //提交成功的回调函数
           
        },
        resetForm:1
       });
       return false
    })
    $('#ua').click(function(){
      $('form[name=ua]').submit()
      return
    })*/
  </script>
</body> 
<html> 

