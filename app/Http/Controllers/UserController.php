<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\NotisAkaunBaru;
use App\Notifications\NotisAkaunBaru as NotificationsNotisAkaunBaru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $senaraiUsers = User::all();

        if (session('type') && session('message'))
        {
            $type = session('type');
            $message = session('message');
        }
        else
        {
            $type = 'primary';
            $message = 'Sila pilih profile pengguna';
        }

        return view('users.index', compact('senaraiUsers', 'type', 'message'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create');

        return view('users.borang-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create');

        $data = $request->validate([
            'nama' => ['required', 'min:3'],
            'email' => ['required', 'email:filter'],
            'password' => ['required', Password::min(3)],
            'role' => ['required', 'in:' . User::ruleRole()],
            'status' => ['required', 'in:' . User::ruleStatus()]
        ]);

        // Dump and die
        // dd($data);

        // Simpan data ke dalam table users
        $user = User::create($data);

        // Hantar email notis akaun baru kepada user baru tersebut
        Mail::to($request->user())->send(new NotisAkaunBaru($user));

        // Hantar notification kepada user baru tersebut
        $user->notify(new NotificationsNotisAkaunBaru($user));

        // Final response. redirect ke senarai users
        return redirect()->route('users.index')
        ->with('type', 'success')
        ->with('message', 'Rekod Berjaya Ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('users.borang-edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $data = $request->validate([
            'nama' => ['required', 'min:3'],
            'email' => ['required', 'email:filter'],
            'role' => ['required', 'in:' . User::ruleRole()],
            'status' => ['required', 'in:' . User::ruleStatus()]
        ]);

        if ($request->has('password') && $request->filled('password'))
        {
            $request->validate([
                'password' => ['required', Password::min(3)],
            ]);

            $data['password'] = $request->input('password');
        }

        $user->update($data);

        return redirect()->route('users.index')
        ->with('type', 'success')
        ->with('message', 'Rekod Berjaya dikemaskini!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()->route('users.index')
        ->with('type', 'success')
        ->with('message', 'Rekod Berjaya dipadam!');
    }
}
