<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $message = 'Selamat Datang ' . auth()->user()->nama;

        return view('dashboard', compact('message'));
    }
}
