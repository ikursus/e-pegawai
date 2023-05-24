@extends('layouts.induk')

@section('content')
<h1>Daftar User Baru</h1>

<form method="POST" action="{{ route('users.store') }}">
    @csrf

    <div class="mb-3">
        <input type="text" class="form-control" name="nama" placeholder="Nama Pengguna">
    </div>

    <div class="mb-3">
        <input type="password" class="form-control" name="password" placeholder="Password Pengguna">
    </div>

    <div class="mb-3">
        <input type="email" class="form-control" name="email" placeholder="Email Pengguna">
    </div>

    <div class="mb-3">
        <select class="form-control" name="role">
            <option>-- Sila Pilih Role --</option>

            @foreach (\App\Models\User::senaraiRole() as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
            @endforeach

        </select>
    </div>

    <div class="mb-3">
        <select class="form-control" name="status">
            <option>-- Sila Pilih Status --</option>

            @foreach (\App\Models\User::senaraiStatus() as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>

    <button type="submit" class="btn btn-primary">Submit</button>

</form>
@endsection
