<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'www.sabanetco.com')
<img src="http://shatel.org/images/front/sabanet-logo.png" class="logo" alt="صبانت">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
