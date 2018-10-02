@extends('base/app')
@section('content')
<h1>Success!</h1>
<hr>
{{config('app.name')}} now recognizes you as {{$data->byond_key}}.
@php
var_dump($data);
@endphp
@endsection