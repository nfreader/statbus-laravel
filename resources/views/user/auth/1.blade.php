@extends('base/app')
@section('content')

<div class="page-header">
  <h2>Authorize remote access</h2>
</div>
<p>
  <code>{{config('app.name')}}</code> would like to access the following account information from <code>{{config('statbus.remote_auth')}}</code>:
<ul>
  <li>Your PhpBB Username</li>
  <li>Your Byond key, if set</li>
  <li>Your Github username, if set</li>
</ul>
</p>

<p>No other information, <em>including your password(s)</em> will be shared with <code>{{config('app.name')}}</code>.</p>

<p><small>When you click proceed, you will be directed to <code>{{config('statbus.remote_auth')}}</code> to complete the authentication process.</small></p>

<p>
  <a class="btn btn-primary" href="{{route('auth.2')}}">Proceed</a>
  {{-- <a class="btn btn-default" href="{{app.url}}">Cancel</a> --}}
</p>
@endsection