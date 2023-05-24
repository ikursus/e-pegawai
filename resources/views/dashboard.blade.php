<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  </head>
  <body>
    <div class="container">
        <h1>Dashboard</h1>

        {{-- @include('components.card', [
            'title' => 'Tajuk Component Card Include',
            'slot' => 'Kontent Component Card Include'
        ])

        <hr>

        @component('components.card', [
            'title' => 'Tajuk Component Card',
        ])

        Konten Component Card

        @endcomponent

        <hr>

        <x-card title="Tajuk Component X-">
            Konten Component Card menerusi X-
        </x-card> --}}

        {{-- <hr> --}}

        <x-alert :type="$type" :message="$message" />

        <hr>

        <a href="{{ route('users.index') }}" class="btn btn-primary">
            Urus Pengguna Sistem
        </a>

        <p>
            Ada
            <span class="text-danger fw-bolder fs-3">
                {{ auth()->user()->unreadNotifications->count() }}
            </span>
            notifikasi belum dibaca.
        </p>

        <hr>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>Jenis Notification</td>
                    <td>Pesanan</td>
                    <td>URL</td>
                    <td>Tindakan</td>
                </tr>
            </thead>
            <tbody>
                @forelse (auth()->user()->notifications as $notification)
                    <tr class="{{ is_null($notification->read_at) ? 'text-danger' : 'text-secondary' }}">
                        <td>{{ $notification->type }}</td>
                        <td>{{ $notification->data['message'] }}</td>
                        <td>{{ $notification->data['url'] }}</td>
                        <td>
                            <a href="{{ route('dashboard', ['notification' => $notification->id]) }}" class="btn btn-primary">
                                Sudah baca
                            </a>
                            <a href="{{ route('dashboard', ['delete' => $notification->id]) }}" class="btn btn-danger">
                                Hapus
                            </a>
                        </td>
                    </tr>
                @empty

                @endforelse
            </tbody>
        </table>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>
