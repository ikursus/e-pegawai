@extends('layouts.induk')

@section('content')

<h1>Ruang Chatting</h1>

<div class="card">

    <div class="card-header">
        <h3>{{ auth()->user()->nama }}</h3>
    </div>

    <div class="card-body">

        <div class="row mb-3">
            <div class="col text-end">

                <div class="badge bg-success mb-3">
                    @include('chat.receive', ['message' => 'Assalamualaikum sahabat'])
                </div>

            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <form>

                    <div class="mb-3">
                        <input type="text" name="message" class="form-control" id="message" autocomplete="off" placeholder="Masukkan mesej">
                    </div>

                    <button type="submit" class="btn btn-primary">Hantar Mesej</button>

                </form>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripting')

@endpush
