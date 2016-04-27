<!DOCTYPE html>
<html>
<head>
    <title>Data Grid</title>

    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <style>

    </style>
    {!! Rapyd::styles() !!}
    <style>
        html, body {
            height: 100%;
            background-color: #EEEEEE;
        }
    </style>
</head>
<body>

<div class="container">
    {!! $filter !!}
    {!! $grid !!}
</div>


<script src="//cdn.bootcss.com/jquery/3.0.0-alpha1/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
{!! Rapyd::scripts() !!}

</body>
</html>