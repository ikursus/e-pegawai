@extends('layouts.induk')

@section('content')
<h1>Kemaskini Profile</h1>

<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PATCH')

    @include('users.form')

    <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>

    <button type="submit" class="btn btn-primary">Submit</button>

</form>
@endsection
