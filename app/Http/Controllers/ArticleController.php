<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Keluarkan data dari table artikel berdasarkan id user yang sedang login
        $senaraiArticles = Article::where('user_id', auth()->id())
        ->paginate(10);

        $type = session('type') ?? 'primary';
        $message = session('message') ?? 'Sila tambah artikel';

        return view('articles.index', compact('senaraiArticles', 'type', 'message'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();

        Article::create($data);

        return redirect()->route('articles.index')
        ->with('type', 'success')
        ->with('message', 'Rekod berjaya disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // if (auth()->id() != $article->user_id)
        // {
        //     abort(401);
        // }
        $this->authorize('view', $article);

        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->all());

        return redirect()->route('articles.index')
        ->with('type', 'success')
        ->with('message', 'Rekod berjaya dikemaskini');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')
        ->with('type', 'success')
        ->with('message', 'Rekod berjaya dipadam');
    }
}
