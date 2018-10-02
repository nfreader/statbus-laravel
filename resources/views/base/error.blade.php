@extends('base/app')
@section('content')
<div class="jumbotron">
  <h1 class="display-4">Error - {{$code}}</h1>
  <p class="lead">{{$message}}</p>
</div>
@endsection
