@extends('base/app')
@section('content')

<h2><a href="{{route('deaths.listing')}}">Deaths</a>/@deathlink(['death'=>$death->id])@enddeathlink 
  @keylink(['name' => $death->name, 'ckey' => $death->byondkey])@endkeylink
</h2>
<hr>

@if($death->lakey)
<div class="row">
  <div class="col">
    <div class="card mb-4">
      <h3 class="card-header bg-danger text-white">Murder Suspect</h3>
      <div class="card-body h4">
        @keylink(['name' => $death->laname, 'ckey' => $death->lakey])@endkeylink
      </div>
    </div>
  </div>
</div>
<hr>
@endif

@if($death->suicide)
<div class="row">
  <div class="col">
    <div class="card mb-4">
      <h3 class="card-header bg-dark text-white">Suicide</h3>
    </div>
  </div>
</div>
<hr>
@endif

<div class="row">
  <div class="col-lg-4 col-md-12">
    <div class="card mb-4">
      <h3 class="card-header">Cause of Death</h3>
      <div class="card-body h4">
        {{$death->cause}}
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-12">
    <div class="card mb-4">
      <h3 class="card-header">Vital Signs</h3>
      <div class="card-body h4">
        @foreach($death->vitals as $k => $v)
        <span title="{{$k}}" class="badge badge-dam badge-{{$k}}">{{$v}}</span>
        @endforeach
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-12">
    <div class="card mb-4">
      <h3 class="card-header">Rank</h3>
      <div class="card-body h4">
        {{$death->job}}<br>
        @if($death->special)
        <span class="badge badge-danger">{{$death->special}}</span>
        @endif
      </div>
    </div>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-lg-6">
    <div class="card mb-4">
      <h3 class="card-header">Location</h3>
      <div class="card-body h4">
        {{$death->mapname}} - {{$death->pod}} ({{$death->x}}, {{$death->y}}, {{$death->z}})
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-md-12">
    <div class="card mb-4">
      <h3 class="card-header">Time of Death</h3>
      <div class="card-body h4">
        {{$death->tod}}
        <small>{{$death->server}} - @roundlink(['round' => $death->round]) 
          @endroundlink
        </small>
      </div>
    </div>
  </div>
</div>
<hr>
<div class="row">
  <div class="col">
    <div class="card mb-4">
      <h3 class="card-header">Last Words</h3>
      <div class="card-body">
        @if($death->last_words)
        <blockquote class="blockquote text-right">
          <p class="mb-0">{{$death->last_words}}</p>
          <footer class="blockquote-footer">@keylink(['name' => $death->name, 'ckey' => $death->byondkey])@endkeylink, {{$death->last_line}}</footer>
        </blockquote>
        @else 
        <em>We were unable to record their last words, but we can safely assume that they said something poignant and moving in their final moments.</em>
        @endif
    </div>
  </div>
</div>
</div>
@php 
var_dump($death)
@endphp

@endsection