@extends('layouts.induk')

@section('content')
<h1>Daftar Pengguna Baru</h1>

<form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
    @csrf

    @include('users.form')

    <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>

    <button type="submit" class="btn btn-primary">Submit</button>

</form>
@endsection
