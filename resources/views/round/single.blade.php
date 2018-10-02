@extends('base/app')
  @section('content')
  <div class="row">
    <div class="col-md-2 col-sm-12 h3">
      <i class="fas fa-circle"></i> {{$round->id}}<br>
      <small>{{$round->map}}</small>
    </div>
    <div class="col-md-8 col-sm-12 h3 text-center">
      {{$round->mode}}<br>
      <div class="badge badge-{{$round->class}} d-block">
        {{$round->result}}
      </div>
      <small>Started {{$round->start_datetime}}, Ended {{$round->end_datetime}}</small>
    </div>
    <div class="col-md-2 col-sm-12 h3 text-right">
      {{$round->server}}<br>
      {{$round->duration}}
    </div>
  </div>
  <hr>

  @if(empty($round->data))
    @alert(['class' => 'warning', 'title' => 'No Stats', 'message' => "I couldn't find any stats for this round. Data may be missing or incomplete."])
    @endalert
  @endif

  @include('round.view.basic')
  @include('round.view.technical')
  @include('round.view.prs')
  @if(isset($round->data->antagonists))
    <h3>Antagonists</h3>
    <hr>
    @include('stat.special.antagonists', ['data'=>$round->data->antagonists])
  @endif

  @php
  var_dump($round->data);
  @endphp
@endsection