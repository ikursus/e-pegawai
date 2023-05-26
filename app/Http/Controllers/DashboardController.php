<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use PhpParser\ErrorHandler\Collecting;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->has('notification'))
        {
            auth()->user()->notifications->where('id', $request->notification)->markAsRead();
            return redirect()->route('dashboard');
        }

        if ($request->has('delete'))
        {
            auth()->user()->notifications->where('id', $request->delete)->first()->delete();
            // $notification->delete();

            return redirect()->route('dashboard');
        }

        if (session('type') && session('message'))
        {
            $type = session('type');
            $message = session('message');
        }
        else
        {
            $type = 'primary';
            $message = 'Selamat Datang ' . auth()->user()->nama;
        }

        // Dapatkan contoh session jika ada
        $contohSession = session()->get('contoh-session');

        // jika tiada, cipta session contoh tersebut
        // dan kemudian buka semula dashboard
        if (is_null($contohSession))
        {
            session()->put('contoh-session', 'Session contoh sedang aktif');

            return redirect()->route('dashboard');
        }

        // $senaraiArticles = Article::latest('id')->take(3)->get();
        // Sample cache dapatkan 5 latest articles dari dashboard
        // Tempoh masa cache adalah 2 jam = 7200 saat
        $senaraiArticles = Cache::remember('artikel-terkini', 7200, function () {
            return Article::latest('id')->take(3)->get();
        });

        // dd($senaraiArticles);
        $senaraiUsersArray = [
            [
                'id' => 1,
                'nama' => 'Upin',
                'email' => 'upin@gmail.com'
            ],
            [
                'id' => 2,
                'nama' => 'Ipin',
                'email' => 'ipin@gmail.com'
            ],
        ];

        // $senaraiUsersCollection = new Collection($senaraiUsersArray);
        $senaraiUsersCollection = collect($senaraiUsersArray);
        return $senaraiUsersCollection->toJson();

        return view('dashboard', compact(
            'type',
            'message',
            'contohSession',
            'senaraiUsersArray',
            'senaraiUsersCollection',
        ));
    }
}
