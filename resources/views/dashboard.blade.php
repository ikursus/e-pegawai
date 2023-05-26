@extends('layouts.induk')

@section('content')
<h1>Dashboard</h1>

{{-- @include('components.card', [
    'title' => 'Tajuk Component Card Include',
    'slot' => 'Kontent Component Card Include'
])

<hr>

@component('components.card', [
    'title' => 'Tajuk Component Card',
])

Konten Component Card

@endcomponent

<hr>

<x-card title="Tajuk Component X-">
    Konten Component Card menerusi X-
</x-card> --}}

{{-- <hr> --}}

<x-alert :type="$type" :message="$message" />

<hr>

<div class="alert alert-warning">
    {{ $contohSession }}
</div>

<hr>

<p>
    Ada
    <span class="text-danger fw-bolder fs-3">
        {{ auth()->user()->unreadNotifications->count() }}
    </span>
    notifikasi belum dibaca.
</p>

<hr>

<table class="table table-bordered">
    <thead>
        <tr>
            <td>Jenis Notification</td>
            <td>Pesanan</td>
            <td>URL</td>
            <td>Tindakan</td>
        </tr>
    </thead>
    <tbody>
        @forelse (auth()->user()->notifications as $notification)
            <tr class="{{ is_null($notification->read_at) ? 'text-danger' : 'text-secondary' }}">
                <td>{{ $notification->type }}</td>
                <td>{{ $notification->data['message'] }}</td>
                <td>{{ $notification->data['url'] }}</td>
                <td>
                    <a href="{{ route('dashboard', ['notification' => $notification->id]) }}" class="btn btn-primary">
                        Sudah baca
                    </a>
                    <a href="{{ route('dashboard', ['delete' => $notification->id]) }}" class="btn btn-danger">
                        Hapus
                    </a>
                </td>
            </tr>
        @empty

        @endforelse
    </tbody>
</table>

<hr>

<ul>
    @foreach ($senaraiUsersArray as $user)
    <li>{{ $user['id'] }} | {{ $user['nama'] }} | {{ $user['email'] }}</li>
    @endforeach
</ul>

<hr>

<ul>
    @foreach ($senaraiUsersCollection->pluck('email') as $email)
    <li>{{ $email }}</li>
    @endforeach
</ul>


@endsection
