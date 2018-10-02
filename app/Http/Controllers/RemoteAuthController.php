<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;


use Statbus\Statbus;
use Statbus\Remote;

class RemoteAuthController extends Controller {

  public function __construct(){
    if(!Config::get('statbus.remote_auth')){
      return view('base.error', [
        'message' => "This application is not configured for remote authentication.",
        'code'    => 500
      ]);
    }
  }

  public function remoteAuth(){
    $token = (new Statbus)->generateToken(TRUE);
    session(['sb.site_private_token' => base64_encode($token)]);
    session(['sb.return_uri'    => route('auth.3')]);
    $url = Config::get('statbus.remote_auth')."oauth_create_session.php";
    $url.= "?site_private_token=".session('sb.site_private_token');
    $url.= "&return_uri=".urlencode(session('sb.return_uri'));
    $remote = new Remote($url);
    $response = json_decode($remote->url());
    if('OK' != $response->status){
      return view('base.error', [
        'message' => "A remote authentication token could not be generated properly: $response->error",
        'code'    => 500
      ]);
    } else {
      session(['sb.public_token' => $response->session_public_token]);
      session(['sb.session_private_token' => $response->session_private_token]);
    }
    return view('user.auth.1');
  }

  public function remoteAuthRedirect() {
    if(!session('sb.public_token')){
      return view('base.error', [
        'message' => "Missing public token.",
        'code'    => 500
      ]);
    }
    $location = Config::get('statbus.remote_auth')."oauth.php?";
    $location.= "session_public_token=".urlencode(session('sb.public_token'));
    return redirect()->to($location);
  }

  public function finishRemoteAuth(){
    var_dump(session()->all());
    $url = Config::get('statbus.remote_auth')."oauth_get_session_info.php";
    $url.= "?site_private_token=".urlencode(session('sb.site_private_token'));
    $url.= "&session_private_token=".urlencode(session('sb.session_private_token'));
    $remote = new Remote($url);
    $response = json_decode($remote->url());
    var_dump($response);
    if('OK' != $response->status){
      return view('base.error', [
        'message' => "A remote authentication token could not be generated properly: $response->error",
        'code'    => 500
      ]);
    }
    foreach ($response as $k => $v){
      session(['sb.'.$k => $v]);
    }
    return view('user.auth.3',[
      'data'=>$response
    ]);
  }

}
