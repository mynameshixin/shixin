@extends('admin.right')

@section('htmlheader_title')

@endsection

@section('content')
    {!! $edit !!}
@endsection

@section('otherheader')
<script type="text/javascript" src="{{asset('/static/js/uploadify-v2.1.4/uploadFiles.js')}}"></script>
@endsection

@section('otherfooter')
@endsection
@stop




