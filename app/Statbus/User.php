<?php

namespace Statbus;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Auth\UserProvider;

class User implements UserProvider {

  // private $mode = 'IP';

  // protected $table = 'player';

  // protected $columns = [
  //   'ckey',
  //   'byond_key AS byond',
  //   'firstseen',
  //   'firstseen_round_id AS first_round',
  //   'lastseen',
  //   'lastseen_round_id AS last_round',
  //   'ip',
  //   'computerid',
  //   'accountjoindate',
  //   'flags'
  // ];

  // protected $admin_flags = [
  //   'BUILDMODE'   => 1,
  //   'ADMIN'       => 2,
  //   'BAN'         => 4,
  //   'FUN'         => 8,
  //   'SERVER'      => 16,
  //   'DEBUG'       => 32,
  //   'POSSESS'     => 64,
  //   'PERMISSIONS' => 128,
  //   'STEALTH'     => 256,
  //   'POLL'        => 512,
  //   'VAREDIT'     => 1024,
  //   'SOUNDS'      => 2048,
  //   'SPAWN'       => 4096,
  // ];

  // protected $byond;
  // protected $ckey;
  // protected $firstseen;
  // protected $lastseen;
  // protected $first_round;
  // protected $last_round;
  // protected $ip;
  // protected $computerid;
  // protected $accountjoindate;
  // protected $flags;

  // protected $rank = false;

  // public function retrieveById($identifier){

  // }
  // public function retrieveByToken($identifier, $token){

  // }
  // public function updateRememberToken($user, $token){

  // }
  // public function retrieveByCredentials(array $credentials){

  // }
  // public function validateCredentials($user, array $credentials){

  // }


  // public function __construct(){
  //   if(Config::get('statbus.remote_auth')){
  //     $this->mode = 'REMOTE';
  //   }

  //   if ('REMOTE' === $this->mode){
  //     $user = $this->getByCkey(session('sb.byond_ckey'));
  //   } else {

  //   }

  //   $user->rank = $this->getRank($user->ckey);
  //   foreach ($user as $k => $v){
  //     $this->k = $v;
  //   }

  // }

  // public function getByIP(int $ip){
  //   $user = DB::table($this->table)
  //     ->select($this->columns)
  //     ->where([
  //       ['ip', '=', $ip],
  //       ['lastseen', '>=', 'NOW() - INTERVAL(1 DAY)']
  //     ])
  //     ->first();
  //     return $user;
  // }

  // public function getByCkey(string $ckey){
  //   $user = DB::table($this->table)
  //     ->select($this->columns)
  //     ->where('ckey', '=', $ckey)
  //     ->first();
  //     return $user;
  // }

  // public function getRank(string $ckey){
  //   $rank = DB::table('admin')
  //     ->leftJoin('admin_ranks', 'admin_ranks.rank', '=', 'admin.rank')
  //     ->select('admin.rank', 'admin_ranks.flags', 'admin_ranks.exclude_flags', 'admin_ranks.can_edit_flags')
  //     ->where('admin.ckey', $ckey)
  //     ->first();
  //     if(!$rank) return false;
  //     foreach($this->admin_flags as $k => $v){
  //       if($rank->flags & $v){
  //         $rank->permissions[] = $k;
  //       }
  //     }
  //   return $rank;
  // }

  // public function getMe(){
  //   return true;
  // }

}