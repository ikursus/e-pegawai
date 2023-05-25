<div class="mb-3">
    <input type="text" class="form-control" name="nama" placeholder="Nama Pengguna" value="{{ isset($user) ? $user->nama : old('nama') }}">
</div>

<div class="mb-3">
    <input type="password" class="form-control" name="password" placeholder="Password Pengguna">
    @if (url()->current() != route('users.create'))
        <span class="text-muted">Biarkan kosong jika tidak mahu update password</span>
    @endif
</div>

<div class="mb-3">
    <input type="email" class="form-control" name="email" placeholder="Email Pengguna" value="{{ isset($user) ? $user->email : old('email') }}">
</div>

<div class="mb-3">
    <input type="text" class="form-control" name="no_pekerja" placeholder="No. Pekerja" value="{{ isset($user) ? $user->no_pekerja : old('no_pekerja') }}">
</div>

<div class="mb-3">
    <input type="text" class="form-control" name="telefon" placeholder="No. Telefon" value="{{ isset($user) ? $user->telefon : old('telefon') }}">
</div>

<div class="mb-3">
    <input type="text" class="form-control" name="jawatan" placeholder="Jawatan" value="{{ isset($user) ? $user->jawatan : old('jawatan') }}">
</div>

<div class="mb-3">
    <textarea class="form-control" name="alamat" placeholder="Alamat Surat Menyurat">{{ isset($user) ? $user->alamat : old('alamat') }}</textarea>
</div>

<div class="mb-3">
    <select class="form-control" name="role">
        <option>-- Sila Pilih Role --</option>

        @foreach (\App\Models\User::senaraiRole() as $key => $value)
        <option value="{{ $key }}" {{ (isset($user) && $user->role == $key) ? 'selected' : old('role') }}>{{ $value }}</option>
        @endforeach

    </select>
</div>

<div class="mb-3">
    <select class="form-control" name="status">
        <option>-- Sila Pilih Status --</option>

        @foreach (\App\Models\User::senaraiStatus() as $key => $value)
        <option value="{{ $key }}" {{ (isset($user) && $user->status == $key) ? 'selected' : old('status') }}>{{ $value }}</option>
        @endforeach
    </select>
</div>
