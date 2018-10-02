  <h4>Basic Details</h4>
  <hr>
  <table class="table table-bordered table-sm">
    <tbody>
      <tr>
        <th class="text-right align-middle ">Station Name</th>
        <td class="align-middle ">{{$round->station_name}}</td>
        <th class="align-middle text-right">Deaths</th>
        <td class="align-middle">
          <a class="btn btn-primary btn-sm" href="{{route('deaths.round',['round'=>$round->id])}}">{{$round->deaths}} Click to View</a>
        </td>
      </tr>
      <tr>
        <th class="align-middle text-right">Escape Shuttle</th>
        <td class="align-middle">
          @if (!$round->shuttle)
            <em>No Escape Shuttle</em>
          @else
            {{$round->shuttle}}
          @endif
        </td>
        <th class="align-middle text-right">Logs</th>
        <td class="align-middle">
          @if (!$round->logs)
            <em>Not available</em>
          @else
            <a class="btn btn-primary btn-sm" href="{{$round->remote_logs_dir}}" target="_blank" rel="noopener noreferrer">Click Here</a>
          @endif
        </td>
      </tr>
    </tbody>
  </table>