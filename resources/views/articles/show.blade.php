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

        @can('update', $article)
            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-info">
                Edit
            </a>
        @endcan

        @can('delete', $article)
            <form method="POST" action="{{ route('articles.destroy', $article->id) }}">
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
