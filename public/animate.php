<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>resize animate</title>
</head>
<body>
<div id="header">
    <h1>resize animate</h1>
</div>
<div id="container"></div>

<script type="text/x-handlebars-template" id="waterfall-tpl">
{{#data.list}}
    <div class="item" style="width: 250px; height: 250px;float: left; border:3px solid #ccc; margin:10px">
        {{description}}
    </div>
{{/data.list}}
</script>
<script src="js/libs/jquery/jquery.js"></script>
<script src="js/libs/handlebars/handlebars.js"></script>
<script src="js/libs/jquery.easing.js"></script>
<script src="js/waterfall.min.js"></script>
<script>
$('#container').waterfall({
    itemCls: 'item',
    colWidth: 222,
    gutterWidth: 15,
    gutterHeight: 15,
    checkImagesLoaded: false,
    isAnimated: true,
    animationOptions: {
    },
    path: function(page) {
         return '/webd/search/needs?page=' + page+'&keyword=沙发&kind=1';
    }
});
</script>

</body>
</html>
