@extends('admin.right')

@section('htmlheader_title')
    用户管理
@endsection


@section('content')
    <div class="editorMain box box-primary " style="padding: 10px;">
        {!! $filter !!}
        {!! $grid !!}
    </div>
@stop