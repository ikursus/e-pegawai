@extends('layouts.induk')

@section('content')

<div class="card">

    <div class="card-header">
        <h1>Profil {{ $user->nama }}</h1>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <colgroup>
                    <col class="col-4">
                    <col class="col-8">
                </colgroup>

                <thead>
                    <tr>
                        <th>PERKARA</th>
                        <th>BUTIRAN</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>NAMA</td>
                        <td>{{ $user->nama }}</td>
                    </tr>
                    <tr>
                        <td>EMAIL</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>JAWATAN</td>
                        <td>{{ $user->jawatan }}</td>
                    </tr>
                    <tr>
                        <td>ROLE</td>
                        <td>{{ $user->role }}</td>
                    </tr>
                    <tr>
                        <td>ALAMAT</td>
                        <td>{{ $user->alamat }}</td>
                    </tr>
                </tbody>


            </table>
        </div>

    </div>

    <div class="card-footer">
        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            Kembali
        </a>

        @can('update', $user)
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">
                Edit
            </a>
        @endcan

        @can('delete', $user)
            <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Delete
                </button>
            </form>
        @endcan

    </div>
</div>

@endsection
