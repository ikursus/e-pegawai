@extends('layouts.induk')

@section('content')
<h1>Tambah Artikel Baru</h1>

<form method="POST" action="{{ route('articles.store') }}">
    @csrf

    @include('articles.form')

    <button type="submit" class="btn btn-primary">Submit</button>

</form>
@endsection
