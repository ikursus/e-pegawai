@extends('layouts.induk')

@section('content')
<h1>Photos Dari http://jsonplaceholder.typicode.com/photos</h1>

<table class="table table-bordered">
    <colgroup>
        <col class="col-1">
        <col class="col-4">
        <col class="col-7">
    </colgroup>
    <thead>
        <tr>
            <th>ID</th>
            <th>THUMBNAIL</th>
            <th>TITLE</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($senaraiPhotos as $photo)
        <tr>
            <td>{{ $photo->id }}</td>
            <td>
                <img src="{{ $photo->thumbnailUrl }}">
            </td>
            <td>{{ $photo->title }}</td>
        </tr>

        @empty
        <tr>
            <td colspan="3">
                <div class="alert alert-info">
                    Tiada rekod
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>


@endsection
