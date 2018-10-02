<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Statbus\Round;

class RoundController extends Controller {

  protected $table = 'round';
  protected $query = null;
  protected $columns = [
    'tbl.id',
    'tbl.initialize_datetime',
    'tbl.start_datetime',
    'tbl.shutdown_datetime',
    'tbl.end_datetime',
    'tbl.server_port AS port',
    'tbl.commit_hash',
    'tbl.game_mode AS mode',
    'tbl.game_mode_result AS result',
    'tbl.end_state',
    'tbl.shuttle_name AS shuttle',
    'tbl.map_name AS map',
    'tbl.station_name',
    'SEC_TO_TIME(TIMESTAMPDIFF(SECOND, tbl.initialize_datetime, tbl.shutdown_datetime)) AS duration',
    'SEC_TO_TIME(TIMESTAMPDIFF(SECOND, tbl.start_datetime, tbl.end_datetime)) AS round_duration',
    'SEC_TO_TIME(TIMESTAMPDIFF(SECOND, tbl.initialize_datetime, tbl.start_datetime)) AS init_time',
    'SEC_TO_TIME(TIMESTAMPDIFF(SECOND, tbl.end_datetime, tbl.shutdown_datetime)) AS shutdown_time'
  ];

  protected $basicStats = [
    'round_end_stats',
    'shuttle_reason',
    'testmerged_prs',
    'nuclear_challenge_mode',
    'antagonists',
    'explosion',
    'dm_version',
    'byond_version',
    'byond_build',
    'random_seed'
  ];

  public function __construct(){
    $prefix = Config::get('database.connections.mysql.prefix');
    foreach ($this->columns as &$c){
      $c = str_replace('tbl', "`$prefix$this->table`", $c);
    }
    $this->query = implode(', ', $this->columns);
    // var_dump($this->query);
  }

  public function index(){
    try {
    $rounds = DB::table($this->table)
      ->selectRaw($this->query)
      ->whereNotNull('shutdown_datetime')
      ->orderBy('id','desc')
      ->paginate(60);
    } catch (\QueryException $e){
      return view('base.error', [
        'message' => $e->getMessage(),
        'code'    => 500
      ]);
    }
    foreach ($rounds as &$round){
      $round = (new Round)->parseRound($round);
    }
    return view('round.listing', [
      'rounds' => $rounds,
      'wide'   => TRUE
    ]);
  }
  public function single($id){
    $prefix = Config::get('database.connections.mysql.prefix');
    $this->query.=", COUNT(".$prefix."death.id) AS deaths";
    $round = DB::table($this->table)
      ->selectRaw($this->query)
      ->leftJoin('death', 'death.round_id', '=', 'round.id')
      ->where('round.id', '=' ,$id)
      ->first();
    if(!$round->id){
      return view('base.error', [
        'message' => "The round you are looking for, #$id, could not be located.",
        'code'    => 404
      ]);
    }
    $stats = (new StatController)->getArrayOfStats($round->id, $this->basicStats);
    $round->data = new \stdclass;
    foreach($stats as $s){
      $round->data->{$s->key_name} = $s;
    }
    $round = (new Round)->parseRound($round);
    return view('round.single', [
      'round' => $round,
    ]);
  }
  public function singleStat($id, $name){
    $round = DB::table($this->table)
      ->selectRaw($this->query)
      ->where('round.id', '=' ,$id)
      ->first();
    $stat = (new StatController)->getSingleStatForRound($round->id, $name);
    if(!$stat){
      return view('base.error', [
        'message' => "The `$name` stat you are looking for for round #$id, could not be located.",
        'code'    => 404
      ]);
    }
    $round = (new Round)->parseRound($round);
    return view('round.stat', [
      'round' => $round,
      'data'  => $stat
    ]);
  }
}
