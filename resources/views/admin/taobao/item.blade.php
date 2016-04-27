@extends('admin.right')

@section('htmlheader_title')
    淘宝采集
@endsection

@section('content')
    <div class="editorMain box box-primary " style="padding: 10px;">
        <form  action="/admin/taobao/action/detail" method="POST">
            <div class="form-group">

                <label for="sort" class="col-sm-2 control-label required">淘宝网址</label>
                <div class="col-sm-10" id="div_sort">

                    <input class="form-control form-control" type="text" id="url" name="url" value="">

                </div>
            </div>
            <br/>
            <div class="btn-toolbar" role="toolbar">

                <div class="pull-right">
                    <input class="btn btn-primary" type="submit" value="Save">
                </div>
            </div>
        </form>
    </div>
@stop