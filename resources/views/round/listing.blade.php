@extends('base/app')
  @section('content')
  <h2><a href="{{route('rounds.listing')}}">Rounds</a></h2>
  <hr>
  <table class="table table-sm table-bordered">
    <thead>
      <tr>    
        <th>ID</th>   
        <th>Server</th>   
        <th>Mode</th>   
        <th>Result</th>   
        <th>Map</th>    
        <th>Duration</th>   
        <th>Start</th>    
        <th>End</th>    
      </tr>   
    </thead>
    <tbody>
    @foreach ($rounds as $round)
    <tr class="table-{{$round->class}}">
      <td>
        @roundlink(['round'=>$round->id])@endroundlink
      </td>
      <td>{{$round->server}}</td>
      @if ('Undefined' === $round->result)
        <td colspan="2">{{$round->mode}}</td>
      @else
        <td>{{$round->mode}}</td>
        <td>{{$round->result}}</td>
      @endif
      <td>{{$round->map}}</td>
      <td>{{$round->round_duration}}</td>
      <td>{{$round->start_datetime}}</td>
      <td>{{$round->end_datetime}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $rounds->links() }}
@endsection