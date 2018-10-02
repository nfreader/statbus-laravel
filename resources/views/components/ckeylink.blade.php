{{ $name }}<small class="text-muted">/@auth<a href="{{route('tgdb.player', ['ckey'=>$ckey])}}">{{ $ckey }}</a>@endauth
@guest{{$ckey}}@endguest</small>