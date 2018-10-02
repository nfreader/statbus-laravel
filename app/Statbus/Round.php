<?php

namespace Statbus;

use Illuminate\Support\Facades\Config;

class Round {
  public function parseRound(&$round) {

    $servers = Config::get('statbus.servers');
    $gh = Config::get('statbus.github_project');
    $logs = Config::get('statbus.remote_logs');

    $round->mode = ucwords($round->mode);
    $round->result = ucwords($round->result);
    $round->end_state = ucwords($round->end_state);
    $round = $this->mapStatus($round);
    $round->server = $servers[array_search($round->port, array_column($servers,'port'))]['name'];
    // $round = $this->modeIcon($round);
    // $round = $this->mapStatus($round);
    // $app = new statbus(true);
    // $round->server = $app->mapServer($round->server_ip,$round->server_port);

    // //Game mode stuff
    // $round->game_mode = ucfirst($round->game_mode);
    // $round->game_mode_result = ucfirst($round->game_mode_result);

    // if('Undefined' == $round->game_mode_result){
    //   $round->game_mode_result = $round->end_state;
    // }

    // //Cleaning up some errant characters
    $round->shuttle = preg_replace("/[^a-zA-Z\d\s:]/", '', $round->shuttle);
    $round->shuttle = ucwords($round->shuttle);
    if('' == $round->shuttle) $round->shuttle = false;

    // //Map
    // $round->map_name = str_replace('_', ' ', $round->map_name);
    // $round->map_url = str_replace(' ', '', $round->map_name);

    //Revision
    if($round->commit_hash && $gh){
      $round->commit_href = "https://github.com/$gh/commit/$round->commit_hash";
    }

    // //Remote Log Links
    $round->logs = FALSE;
    if($logs){
      $server = strtolower($round->server);
      $date = new \DateTime($round->start_datetime);
      $year = $date->format('Y');
      $month = $date->format('m');
      $day = $date->format('d');
      $round->remote_logs = $logs."$server/data/logs/";
      $round->remote_logs.= "$year/$month/$day/round-$round->id.zip";
      $round->remote_logs_dir = str_replace('.zip', '', $round->remote_logs);
      $round->admin_logs_dir = str_replace('parsed-logs', 'raw-logs', $round->remote_logs_dir);
      $round->logs = TRUE;
      // $round->zipCache = TMPDIR."/".$round->id."-".$round->server.".zip";
    }

    // if(isset($round->stats)){
    //   foreach ($round->stats as $k => $v){
    //     $round->stats[] = $v->key_name;
    //     unset($round->stats[$k]);
    //   }
    //   sort($round->stats);
    // }

    // if(!isset($round->duration)){
    //   $start = new DateTime($round->start_datetime);
    //   $end   = new DateTime($round->end_datetime);
    //   $interval = $end->diff($start);
    //   $round->duration = $interval->format('%H:%I:%S');
    // }

    return $round;
  }

  public function mapStatus(&$round) {
    if ('' === $round->result || 'Undefined' === $round->result){
      $round->result = $round->end_state;
    }
    if(strpos($round->result, 'Win - ') !== FALSE){
      $round->class = 'success';
    } else if (strpos($round->result, 'Loss - ') !== FALSE) {
      $round->class = 'danger';
    } else if (strpos($round->result, 'Halfwin - ') !== FALSE) {
      $round->class = 'warning';
    } else if (strpos($round->result, 'Admin Reboot - ') !== FALSE) {
      $round->class = 'reboot';
    } else if ('Nuke' === $round->result) {
      $round->class = 'inverse';
    } else if ('Restart Vote' === $round->result) {
      $round->class = 'vote';
    } else {
      $round->class = 'proper';
    }
    return $round;
  }
}