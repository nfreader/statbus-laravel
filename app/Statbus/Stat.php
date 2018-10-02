<?php

namespace Statbus;

use Illuminate\Support\Facades\Config;

class Stat {

  public function parseStat(&$stat) {
    $stat->raw = $stat->json;
    $stat->json = json_decode($stat->json)->data;
    $stat->labels = new \stdclass;
    $stat->labels->key = 'Path';
    $stat->labels->value = 'Total';
    $stat->labels->total = 'Total Overall';
    $stat->splain = null;
    $stat->special = false;
    $stat = $this->formatStat($stat);
    switch($stat->key_type){
      case 'tally':
        $stat->total = array_sum((array) $stat->json);
      break;
    }
    return $stat;
  }

  public function formatStat(&$stat){

    switch ($stat->key_name){
      case 'antagonists':
        $stat->special = true;
        foreach ($stat->json as &$j){
          $j->class = str_replace("/datum/antagonist/", '', $j->antagonist_type);
          $j->class = "antag ".str_replace("/", ' ', $j->class);
        }
      break;

      case 'food_made':
        $stat->labels->key   = 'Food Name';
        $stat->labels->value = 'Total Created';
        $stat->labels->total = 'Total Food Created';
      break;

      case 'radio_usage':
        $stat->labels->key   = 'Radio Channel';
        $stat->labels->value = 'Messages Transmitted';
        $stat->labels->total = 'Total Messages Transmitted';
      break;

      case 'religion_deity':
        $stat->splain = 'The Crew Worshipped';
      break;

      case 'religion_name':
        $stat->splain = 'The Crew Practiced';
      break;

      case 'testmerged_prs':
        $stat->special = true;
        $gh = Config::get('statbus.github_project');
        $stat->json = (object) array_keys((array) $stat->json);
        foreach ($stat->json as &$j){
          $tmp = new \stdclass;
          $tmp->pr   = $j;
          $tmp->href = "https://github.com/$gh/pulls/$j";
          $j = $tmp;
        }
      break;
    }
    return $stat;
  }

}