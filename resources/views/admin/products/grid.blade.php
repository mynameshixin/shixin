@extends('admin.right')

@section('htmlheader_title')
    列表
@endsection


@section('content')
    <div class="editorMain box box-primary " style="padding: 10px;">
        {!! $filter !!}
        {!! $grid !!}
    </div>
@stop