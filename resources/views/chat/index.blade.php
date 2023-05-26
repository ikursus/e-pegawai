@extends('layouts.induk')

@section('content')

<h1>Ruang Chatting</h1>

<div class="card">

    <div class="card-header">
        <h3>{{ auth()->user()->nama }}</h3>
    </div>

    <div class="card-body">

        <div class="row mb-3">
            <div class="col text-start">

                <div class="chat">

                    <div class="alert alert-info mb-3">
                        <div class="messages">
                            @include('chat.receive', ['message' => 'Assalamualaikum sahabat'])
                        </div>
                    </div>

                </div>


            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <form>

                    <div class="mb-3">
                        <input type="text" name="message" class="form-control" id="message" autocomplete="off" placeholder="Masukkan mesej">
                    </div>

                    <button type="submit" class="btn btn-primary">Hantar Mesej</button>

                </form>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripting')
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
      cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}'
    });

    var channel = pusher.subscribe('public');

    channel.bind('chat', function(data) {
        $.post("{{ route('chat.receive') }}", {
            _token: "{{ csrf_token() }}",
            message: data.message,
        })
        .done(function(respon) {
            // Append mesej yang diterima dari mesej sebelumnya
            $(".messages > .message").last().after(respon);
            // Scroll content selepas send supaya mesej yang terkumpul boleh dibaca
            $(document).scrollTop((document).height());
        });

        //alert(JSON.stringify(data));
    });

    // Hantar mesej kepada route send supaya dibroadcast ke pusher
    $("form").submit(function (event) {

        // Elakkan form page reload submit
        event.preventDefault();

        $.ajax({
            url: "{{ route('chat.send') }}",
            method: "POST",
            headers: {
                'X-Socket-Id': pusher.connection.socket_id
            },
            data: {
                _token: "{{ csrf_token() }}",
                message: $("form #message").val(),
            }
        }).done(function( respon ) {
            // Append mesej yang diterima dari mesej sebelumnya
            $(".messages > .message").last().after(respon);
            // Clearkan input message selepas send
            $("form #message").val('');
            // Scroll content selepas send supaya mesej yang terkumpul boleh dibaca
            $(document).scrollTop((document).height());
        });

    });



  </script>
@endpush
