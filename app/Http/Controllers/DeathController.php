<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Statbus\Death;

class DeathController extends Controller {

  protected $table = 'death';
  protected $columns = [
    'id',
    'pod',
    'x_coord AS x',
    'y_coord AS y',
    'z_coord AS z',
    'server_port AS port',
    'round_id AS round',
    'mapname',
    'tod',
    'job',
    'special',
    'name',
    'byondkey',
    'laname',
    'lakey',
    'bruteloss AS brute',
    'brainloss AS brain',
    'fireloss AS fire',
    'oxyloss AS oxy',
    'toxloss AS tox',
    'cloneloss AS clone',
    'staminaloss AS stamina',
    'last_words',
    'suicide'
  ];

  public function getListing(){
    $deaths = DB::table($this->table)
      ->select($this->columns)
      ->orderBy('tod','desc')
      ->paginate(60);
    foreach($deaths as &$death){
      $death = (new Death)->parseDeath($death);
    }
    return view('death.listing', [
      'deaths'  => $deaths,
      'wide'    => TRUE
    ]);
  }

  public function getDeath($id){
    $death = DB::table($this->table)
      ->select($this->columns)
      ->where('id', $id)
      ->first();
    $death = (new Death)->parseDeath($death);
    return view('death.single', [
      'death'  => $death,
    ]);
  }

  public function getDeathsForRound($round){
    $deaths = DB::table($this->table)
      ->select($this->columns)
      ->where('round_id', $round)
      ->orderBy('tod','desc')
      ->paginate(60);
    foreach($deaths as &$death){
      $death = (new Death)->parseDeath($death);
    }
    return view('death.listing', [
      'deaths'  => $deaths,
      'round'   => $round,
      'wide'    => TRUE
    ]);
  }

  public function finalWords(){
    $deaths = DB::table($this->table)
      ->select('last_words','id')
      ->where('last_words','!=','')
      ->inRandomOrder()
      ->limit(1000)
      ->get();
    return view('death.finalwords', [
      'deaths'  => $deaths
    ]);
  }
  
}
