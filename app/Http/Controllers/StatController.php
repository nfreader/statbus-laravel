<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Statbus\Stat;

class StatController extends Controller {

  protected $table = 'feedback';

  public function getSingleStatForRound($round, $name){
    $stat = DB::table($this->table)
      ->select('key_name', 'key_type', 'version', 'json')
      ->where([
        ['round_id', $round],
        ['key_name', $name]
      ])
      ->first();
    if(!$stat){
      return false;
    }
    $stat = (new Stat)->parseStat($stat);
    return $stat;
  }

  public function getArrayOfStats(int $round, array $stats) {
    $stats = DB::table($this->table)
      ->select('key_name', 'key_type', 'version', 'json')
      ->where('round_id', $round)
      ->whereIn('key_name', $stats)
      ->get();
    foreach ($stats as &$s){
      $s = (new Stat)->parseStat($s);
    }
    return $stats;
  }
}
