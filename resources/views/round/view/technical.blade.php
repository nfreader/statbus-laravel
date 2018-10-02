<h4 data-target="#technical" data-toggle="collapse">Technical Details</h4>
  <hr>
  <table class="table table-bordered table-sm" id="technical">
    <tbody>
      <tr>
        <th class="align-middle text-right">Round Duration</th>
        <td class="align-middle">{{$round->duration}}</td>
        <th class="align-middle text-right">Commit</th>
        <td class="align-middle"><code><a class="btn btn-primary btn-sm" href="{{$round->commit_href}}" target="_blank" rel="noopener noreferrer">{{substr($round->commit_hash, 0,7)}} <i class="fas fa-external-link-alt"></i></a></code>
        </td>
      </tr>
      <tr>
        <th class="align-middle text-right">Initialization Duration</th>
        <td class="align-middle">{{$round->init_time}}</td>
        <th class="align-middle text-right">Shutdown Duration</th>
        <td class="align-middle">{{$round->shutdown_time}}</td>
      </tr>
      <tr>
        <th class="align-middle text-right">Initialization Time</th>
        <td class="align-middle">{{$round->initialize_datetime}}</td>
        <th class="align-middle text-right">Shutdown Time</th>
        <td class="align-middle">{{$round->shutdown_datetime}}</td>
      </tr>
      <tr>
        @if(isset($round->data->byond_version))
        <th class="align-middle text-right">Byond Version</th>
        <td class="align-middle">{{$round->data->byond_version->json}}</td>
        @endif
        @if(isset($round->data->byond_build))
        <th class="align-middle text-right">Byond Build</th>
        <td class="align-middle">{{$round->data->byond_build->json}}</td>
        @endif
      </tr>
      <tr>
        @if(isset($round->data->dm_version))
        <th class="align-middle text-right">DM Version</th>
        <td class="align-middle">{{$round->data->dm_version->json}}</td>
        @endif
        @if(isset($round->data->byond_build))
        <th class="align-middle text-right">Random Seed</th>
        <td class="align-middle">{{$round->data->random_seed->json}}</td>
        @endif
      </tr>
      @if(isset($round->data->testmerged_prs))
      <tr>
        <th class="align-middle text-right">Testmerged PRs</th>
        <td class="align-middle" colspan='3'>
          @foreach ($round->data->testmerged_prs->json as $pr)
          <a href="{{$pr->href}}" target="_blank" rel="noopener noreferrer">{{$pr->pr}} <i class="fas fa-external-link-alt"></i></a> 
          @endforeach
        </td>
      </tr>
      @endif
    </tbody>
  </table>