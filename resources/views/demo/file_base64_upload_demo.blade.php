<!DOCTYPE html>
<html>
<head>
    <title>文件上传demo</title>
</head>
<body>
<div style="display: block; margin-top: 50px;margin-left: 50px;">
    <div>
        <input id='img_name_id' type="file" value=""/>
        <label style="color:red">上传文件</label><br>
    </div>
    <div>
        <input type="text" name="md5_name" value=""/>
        <label style="color:red">md5_name md5值</label><br>
    </div>
</div>
    <pre>
        获取图片url： FileService::getImg($img_md5, $width)
    </pre>
<script src="<?php echo asset('static/js/jquery.min.js');?>"></script>
<script type="text/javascript">
    $(function () {
        var inputFile = document.getElementById('img_name_id'),
            uploadInfo = {},
            jcropContainer;
        // 监听文件改变
        inputFile.addEventListener('click', function () {
            this.value = null;
        }, false);
        inputFile.addEventListener('change', readData, false);

        // 文件改变响应
        function readData(evt) {
            evt.stopPropagation();
            evt.preventDefault();

            uploadInfo = {};
            var file = evt.dataTransfer !== undefined ? evt.dataTransfer.files[0] : evt.target.files[0];
            uploadInfo.type = file.type;
            uploadInfo.name = file.name;
            uploadInfo.size = file.size;

            if (!file.type.match(/image.*/)) {
                return;
            }

            var reader = new FileReader();

            reader.onload = (function () {
                return function (e) {
                    uploadInfo.img_content = e.target.result;

                    var imageObj = new Image();
                    imageObj.src = uploadInfo.img_content;
                    imageObj.onload = function () {
                        uploadCard();
                    }
                }
            })(file);

            reader.readAsDataURL(file);
        }

        // 上传名片
        function uploadCard() {
            var params = uploadInfo;
            var request = $.ajax({
                url: '/file/base64/upload',
                type: "post",
                data: params,
                dataType: 'json'
            });
            request.success(function (data) {
                if(data.status == 'error'){
                    alert('上传失败');
                    return false;
                }
                $('input[name="md5_name"]').val(data.result.img_md5);
            });
        }
    });
</script>
</body>
</html>