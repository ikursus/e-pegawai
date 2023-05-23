<x-mail::message>

Tahniah, akaun anda telah berjaya dicipta.
Sila login ke akaun anda menggunakan email: {{ $user->email }}
    dan password yang telah anda tetapkan.

<x-mail::button :url="'http://e-pegawai.test'">
Login di sini
</x-mail::button>

- Item 1
- Item 2
- Item 3

<x-mail::table>
| Nama       | Email     |
| ---------- |---------|
| {{ $user->nama }}  | {{ $user->email }}|

</x-mail::table>

Sekian, terima kasih.
{{ config('app.name') }}


</x-mail::message>
