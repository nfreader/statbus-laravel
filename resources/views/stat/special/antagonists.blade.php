
@foreach ($data->json as $a)
<div class="card mb-4 {{$a->class}}">
  <h4 class="card-header">
    @keylink([
      'name'=> $a->name,
      'ckey'=> $a->key
    ])
    @endkeylink
  </h4>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><strong>Antagonist</strong> {{$a->antagonist_name}}<small class="text-muted">{{$a->antagonist_type}}</small></li>
    <li class="list-group-item"><strong>Team</strong> {{$a->team->name}}<small class="text-muted">{{$a->team->type}}</small></li>
  </ul>
</div>
{{-- @php
  var_dump($a);
@endphp --}}
@endforeach