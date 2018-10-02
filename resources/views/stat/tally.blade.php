<table class="table table-sm table-bordered sort">
  <thead>
    <th>{{$data->labels->key}}</th>
    <th>{{$data->labels->value}}</th>
  </thead>
  <tbody>
@foreach($data->json as $k => $v)
  <tr>
    <td>{{$k}}</td>
    <td>{{$v}}</td>
  </tr>
@endforeach
  </tbody>
  <tfoot>
    <tr>
      <th>{{$data->labels->total}}</th>
      <td>{{$data->total}}</td>
    </tr>
  </tfoot>
</table>