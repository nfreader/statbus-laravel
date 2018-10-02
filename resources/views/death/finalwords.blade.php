@extends('base/app')
@section('content')
<h2><a href="{{route('deaths.listing')}}">Deaths</a>/Famous Last Words</h2>
<hr>
<em>
@foreach($deaths as $death)
<a href="{{route('deaths.single', ['id'=>$death->id])}}">{{$death->last_words}}</a>
@endforeach
</em>
@endsection
