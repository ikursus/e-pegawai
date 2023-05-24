@extends('layouts.induk')

@section('content')
<h1>Kemaskini Artikel</h1>

<form method="POST" action="{{ route('articles.update', $article->id) }}">
    @method('PATCH')
    @csrf

    @include('articles.form')

    <button type="submit" class="btn btn-primary">Submit</button>

</form>
@endsection
