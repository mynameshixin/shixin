@extends('admin.right')

@section('htmlheader_title')
    详情
@endsection

@section('content')
    <div class="editorMain box box-primary " style="padding: 10px;">
        {!! $edit !!}
    </div>
@stop