@extends('base/app')
@section('content')

<h2><a href="{{route('deaths.listing')}}">Deaths</a> @if(isset($round))<a href="{{route('deaths.listing')}}">Deaths</a>/@roundlink(['round'=>$round])@endroundlink @endif <a href="{{route('deaths.finalwords')}}" class="btn btn-primary float-right">Some Famous Last Words</a></h2>
<hr>
<table class="table table-sm table-bordered">
  <thead>
    <tr>
      <th class="align-middle">ID</th>
      <th class="align-middle">Who</th>
      <th class="align-middle">Where</th>
      <th class="align-middle">When</th>
      <th class="align-middle">
        <span title="Brute"  data-toggle="tooltip" class="badge badge-dam badge-brute">BRU</span>
        <span title="Brain"  data-toggle="tooltip" class="badge badge-dam badge-brain">BRA</span>
        <span title="Fire"   data-toggle="tooltip" class="badge badge-dam badge-fire">FIR</span>
        <span title="Oxygen" data-toggle="tooltip" class="badge badge-dam badge-oxy">OXY</span>
        <span title="Toxin"  data-toggle="tooltip" class="badge badge-dam badge-tox">TOX</span>
        <span title="Clone"  data-toggle="tooltip" class="badge badge-dam badge-clone">CLN</span>
        <span title="Stamina"data-toggle="tooltip" class="badge badge-dam badge-stamina">STM</span>
      </th>
    </tr>
  </thead>
  <tbody>
    @unless(count($deaths))
    <tr>
      <td class="text-center" colspan="5">No Deaths Could Be Located For This Round</td>
    </tr>
    @endunless
    @foreach ($deaths as $d)
    <tr class="table-{{$d->class}}">
      <td class="align-middle">
        @deathlink(['death'=>$d->id])@enddeathlink<br>
        @if($d->suicide)
        <span class="badge badge-danger">Suicide</span>
        @elseif ($d->lakey)
        <span class="badge badge-danger">Murder</span>
        @endif
      </td>
      <td class="align-middle">
        @keylink([
          'name'=> $d->name,
          'ckey'=> $d->byondkey
        ])
        @endkeylink
          <br>As {{$d->job}} @if($d->special) <em>({{$d->special}})</em> @endif
      </td>
      <td class="align-middle">
        {{$d->mapname}} - {{$d->pod}} ({{$d->x}}, {{$d->y}}, {{$d->z}})<br>
        @if($d->last_words) <small><em>{{$d->last_words}}</em></small> @endif
      </td>
      <td class="align-middle">
        {{$d->tod}}<br>
        <small>{{$d->server}} - @roundlink(['round' => $d->round]) 
          @endroundlink
        </small>
      </td>
      <td class="align-middle">
        @foreach($d->vitals as $k => $v)
        <span title="{{$k}}" class="badge badge-dam badge-{{$k}}">{{$v}}</span>
        @endforeach
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $deaths->links() }}
@endsection
