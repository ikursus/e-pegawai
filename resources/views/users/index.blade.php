@extends('layouts.induk')

@section('content')
<h1>Senarai Users</h1>

<x-alert :type="$type" :message="$message" />

<a href="{{ route('users.create') }}" class="btn btn-primary mt-2">Tambah User</a>

<hr>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>NAMA</th>
            <th>EMAIL</th>
            <th>ROLE</th>
            <th>NO PEKERJA</th>
            <th>STATUS</th>
            <th>TINDAKAN</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($senaraiUsers as $user)
        <tr>
            <td>{{ $user->nama }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->no_pekerja }}</td>
            <td>{{ $user->status }}</td>
            <td>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">
                    Edit
                </a>
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="6">
                <div class="alert alert-info">
                    Tiada rekod
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
