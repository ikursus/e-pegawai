@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
<img src="https://picsum.photos/200/300" class="logo" alt="Laravel Logo">
{{ $slot }}
</a>
</td>
</tr>
