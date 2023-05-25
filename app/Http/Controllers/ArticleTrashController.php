<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleTrashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Keluarkan data dari table artikel berdasarkan id user yang sedang login
        $senaraiArticles = Article::onlyTrashed()->paginate(10);

        $type = session('type') ?? 'primary';
        $message = session('message') ?? 'Sila pilih artikel untuk lihat';

        return view('articles.trash', compact('senaraiArticles', 'type', 'message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $article = Article::onlyTrashed()->whereId($id)->first();

        $this->authorize('restore', $article);

        $article->restore();

        return redirect()->route('articles.show', $article->id)
        ->with('type', 'success')
        ->with('message', 'Rekod berjaya dikembalikan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::onlyTrashed()->whereId($id)->first();

        $this->authorize('forceDelete', $article);

        $article->forceDelete();

        return redirect()->route('trash.articles.index')
        ->with('type', 'success')
        ->with('message', 'Rekod berjaya dipadam sepenuhnya daripada table');
    }
}
