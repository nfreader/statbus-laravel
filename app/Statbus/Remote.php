<?php

namespace Statbus;

use Illuminate\Support\Facades\Config;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Remote {

  protected $client;

  protected $uri;
  protected $method = 'GET';

  public function __construct(string $uri, string $method = 'GET') {
    $this->uri = rtrim($uri,'/');
    $this->method = $method;
    $this->client = new Client([
      'headers'        => [
        'Accept-Encoding' => 'gzip',
        'User-Agent'      => Config::get('app.name')." - ".Config::get('statbus.version'),
      ]
    ]);
  }

  public function url(){
    try{
      $res = $this->client->request($this->method,$this->uri);
    } catch (Exception $e){
      die($e->getMessage());
    }
    return (string) $res->getBody();
  }

}