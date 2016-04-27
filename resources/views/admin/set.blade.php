@extends('admin.main')

@section('content')
    <p>
        //cycle
        @foreach ($dataset->data as $item)

            {{ $item->name }}<br />
            {{ $item->roles->name }}<br />

        @endforeach

        {{ $dataset->links() }} <br />

        //sort link
        {{ $dataset->orderbyLink('title', 'asc') }} <br />
    </p>
@stop
