@extends('base/app')
@section('content')
  @include('stat.header')
  @if($data->special)
    @includeIf('stat.special.'.$data->key_name)
  @else
    @includeIf('stat.'.$data->key_type)
  @endif
  <hr>
  @php 
    var_dump($data);
  @endphp
@endsection