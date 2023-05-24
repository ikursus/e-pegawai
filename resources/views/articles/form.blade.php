<div class="mb-3">
        <input type="text" class="form-control" name="tajuk" placeholder="Tajuk Article" value="{{ isset($article) ? $article->tajuk : old('tajuk') }}">
    </div>

    <div class="mb-3">
        <textarea class="form-control" name="kandungan">{{ isset($article) ? $article->kandungan : old('kandungan') }}
        </textarea>
    </div>

    <div class="mb-3">
        <select class="form-control" name="status">
            <option value="">-- Sila Pilih Status --</option>

            @foreach (\App\Models\Article::senaraiStatus() as $key => $value)
            <option value="{{ $key }}" {{ isset($article) && $article->status == $key ? 'selected' : NULL  }}>{{ $value }}</option>
            @endforeach

        </select>
    </div>

    <a href="{{ route('articles.index') }}" class="btn btn-secondary">Kembali</a>
