<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
<div class="container">
<a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarCollapse">
<ul class="navbar-nav me-auto mb-2 mb-md-0">
<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Home</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('users.index') }}">Direktori Pengguna</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('articles.index') }}">Artikel</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('tokens.index') }}">Access Token</a>
</li>
</ul>
{{-- <form class="d-flex" role="search">
<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
<button class="btn btn-outline-success" type="submit">Search</button>
</form> --}}
    <a class="btn btn-outline-danger ms-2" href="/logout">Logout {{ auth()->user()->nama }}</a>
</div>
</div>
</nav>
