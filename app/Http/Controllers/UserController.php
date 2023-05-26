<?php

namespace App\Http\Controllers;

use App\Events\PenggunaTelahMendaftar;
use App\Models\User;
use App\Mail\NotisAkaunBaru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use App\Notifications\NotisAkaunBaru as NotificationsNotisAkaunBaru;
use Illuminate\Support\Facades\Storage;

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

        $request->validate([
            'nama' => ['required', 'min:3'],
            'email' => ['required', 'email:filter'],
            'password' => ['required', Password::min(3)],
            'role' => ['required', 'in:' . User::ruleRole()],
            'status' => ['required', 'in:' . User::ruleStatus()],
            'gambar' => ['nullable', 'sometimes', 'mimes:png,jpg']
        ]);
        // Dapatkan semua data KECUALI gambar
        $data = $request->except('gambar');

        // Semak jika ada file di upload
        if ($request->hasFile('gambar'))
        {
            // Dapatkan file
            $file = $request->file('gambar');

            // Simpan file dalam folder public_uploaded dan dapatkan nama baru
            $fileName = $file->store('profile', 'public_uploaded');

            // Attachkan nama gambar pada $data untuk disimpan di dalam table users
            $data['gambar'] = $fileName;
        }

        // Dump and die
        // dd($data);

        // Simpan data ke dalam table users
        $user = User::create($data);

        // Hantar email notis akaun baru kepada user baru tersebut
        // Mail::to($request->user())->send(new NotisAkaunBaru($user));

        // Hantar notification kepada user baru tersebut
        // $user->notify(new NotificationsNotisAkaunBaru($user));

        // Hantar maklumat $user kepada Event & Listener berkaitan
        // Cara 1
        // PenggunaTelahMendaftar::dispatch($user);
        // Cara 2
        event(new PenggunaTelahMendaftar($user));


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
        // $this->authorize('view', $user);

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

        $request->validate([
            'nama' => ['required', 'min:3'],
            'email' => ['required', 'email:filter'],
            'password' => ['nullable', 'sometimes', Password::min(3)],
            'role' => ['required', 'in:' . User::ruleRole()],
            'status' => ['required', 'in:' . User::ruleStatus()],
            'gambar' => ['nullable', 'sometimes', 'mimes:png,jpg']
        ]);

        // Dapatkan semua data kecuali password dan gambar
        $data = $request->except(['password', 'gambar']);

        // Semak jika ada password untuk diubah
        if ($request->has('password') && $request->filled('password'))
        {
            // Attachkan password ke $data supaya dikemaskini ke dalam table user
            $data['password'] = $request->input('password');
        }

        // Semak jika ada file di upload
        if ($request->hasFile('gambar'))
        {
            // Dapatkan file
            $file = $request->file('gambar');

            // Semak jika ada file lama dalam direktori upload.
            // Jika ada, delete terlebih dahulu
            if (!is_null($user->gambar) && Storage::disk('public_uploaded')->exists($user->gambar))
            {
                Storage::disk('public_uploaded')->delete($user->gambar);
            }

            // Simpan file dalam folder public_uploaded dan dapatkan nama baru
            $fileName = $file->store('profile', 'public_uploaded');

            // Attachkan nama gambar pada $data untuk disimpan di dalam table users
            $data['gambar'] = $fileName;
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
