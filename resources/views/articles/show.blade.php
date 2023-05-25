@extends('layouts.induk')

@section('content')

<div class="card">

    <div class="card-header">
        <h1>{{ $article->tajuk }}</h1>
    </div>

    <div class="card-body">
        {{ $article->kandungan }}
    </div>

    <div class="card-footer">
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>
</div>

@endsection
