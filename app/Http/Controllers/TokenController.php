<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(auth()->id());

        $type = 'primary';
        $message = 'Senarai Access Token Anda';

        return view('token', compact('user', 'type', 'message'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3']
        ]);

        $user = User::find(auth()->id());

        $token = $user->createToken($request->input('name'))->plainTextToken;

        return redirect()->route('tokens.index')
        ->with('token', $token)
        ->with('type', 'success')
        ->with('message', 'Access Token berjaya dicipta. Sila simpan token ini dengan baik kerana ia dipaparkan sekali sahaja.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find(auth()->id());

        $user->tokens()->where('id', $id)->delete();

        return redirect()->route('tokens.index')
        ->with('type', 'success')
        ->with('message', 'Token berjaya dipadam');
    }
}
