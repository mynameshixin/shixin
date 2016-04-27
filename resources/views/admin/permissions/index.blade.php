@extends('admin.main')

@section('htmlheader_title')
    门店管理
@endsection


@section('content')
    {!! $filter !!}
    {!! $grid !!}
@stop