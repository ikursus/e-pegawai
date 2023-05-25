@extends('layouts.induk')

@section('content')
<h1>Personal Access Token</h1>

<x-alert :type="$type" :message="$message" />

<hr>

<form method="POST" action="{{ route('tokens.store') }}">
@csrf

<div class="mb-3">
    <input type="text" name="name" class="form-control" placeholder="Nama Token" value="{{ session('token') }}" required>
</div>

<button type="submit" class="btn btn-primary">
    Generate Access Token Baru
</button>

</form>

<hr>

<table class="table table-bordered">
    <colgroup>
        <col class="col-1">
        <col class="col-9">
        <col class="col-2">
    </colgroup>
    <thead>
        <tr>
            <td>#</td>
            <td>Nama Token</td>
            <td>Tindakan</td>
        </tr>
    </thead>
    <tbody>
        @forelse ($user->tokens as $token)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $token->name }}</td>
                <td>

                    <form method="POST" action="{{ route('tokens.destroy', $token->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Delete
                        </button>
                    </form>

                </td>
            </tr>
        @empty
        <tr>
            <td colspan="3">
                <div class="alert alert-info">
                    Tiada Rekod
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection

