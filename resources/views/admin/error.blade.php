@extends('admin.right')
@section('htmlheader_title')
    错误页
@endsection

@section('content')

    <div class="content-wrapper" style="min-height: 868px;">
        <div class="container">
            <!-- Main content -->
            <section class="content">
                <div class="callout callout-danger">
                    <h4>Error!</h4>

                    <p> {{ $message }}</p>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>


@stop