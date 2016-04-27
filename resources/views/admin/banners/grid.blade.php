@extends('admin.right')

@section('htmlheader_title')
    列表页
@endsection

@section('otherheader')
    <style>
        button {margin-right: 3px;}
    </style>
@endsection


@section('content')
    <div class="editorMain box box-primary " style="padding: 10px;">
        {!! $filter !!}

        {!! $grid !!}
    </div>
@endsection