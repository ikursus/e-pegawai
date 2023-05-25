@extends('layouts.induk')

@section('content')
<h1>Direktori Pengguna</h1>

<x-alert :type="$type" :message="$message" />

@can('create')
<a href="{{ route('users.create') }}" class="btn btn-primary mt-2">Tambah Profil Pengguna</a>
@endcan

<hr>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>GAMBAR</th>
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
            <td>
                @if (!is_null($user->gambar))
                <img src="{{ asset('uploaded/' . $user->gambar) }}" width="100px" class="img-thumbnail rounded float-start" />
                @else
                TIADA GAMBAR
                @endif

            </td>
            <td>{{ $user->nama }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->no_pekerja }}</td>
            <td>{{ $user->status }}</td>
            <td>
                <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary">
                    View
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
