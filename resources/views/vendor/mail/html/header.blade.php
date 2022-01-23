<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="http://shatel.org/images/front/shatel-logo.svg" class="logo" alt="صبانت">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
