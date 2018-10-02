
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
    body {
      padding: 80px 0 0 0;
    }
    .alert-inverse,
    .badge-inverse,
    tr.table-inverse td {
      color: white;
      background: black;
    }
    .alert-vote,
    .badge-vote,
    tr.table-vote td {
      background: rebeccapurple;
      color: white;
    }
    .alert-reboot,
    .badge-reboot,
    tr.table-reboot td {
      background: #e8b575;
    }

    .table-murder td:first-child {
      border-left: .3rem solid red;
    }

    .table-suicide td:first-child {
      border-left: .3rem solid black;
    }

    .alert-proper,
    .badge-proper {
      border: 1px solid #ccc;
    }
    .antag h4:before{
      padding: 4px;
      border: 1px solid black;
      border-radius: 4px;
      font-size: 10px;
      font-weight: bold;
      position: relative;
      top: -5px;
    }
    .rev.head h4:before {
      content: 'H';
      background: blue;
      color: white;
    }
    .rev h4:before {
      content: 'R';
      background: red;
      color: white;
    }
    .badge-dam {
      min-width: 36px;
      display: inline-block !important;
    }
    .badge-brute  {background: #fb264b; color: white;}
    .badge-brain  {background: #5995ba; color: white;}
    .badge-fire   {background: #e0a003; color: white;}
    .badge-oxy    {background: #689bc3; color: white;}
    .badge-tox    {background: #61af25; color: white;}
    .badge-clone  {background: #ab63d8; color: white;}
    .badge-stamina{background: #0e22aa; color: white;}
    </style>
    <title>App Name - @yield('title')</title>
    </head>
    <body>
      <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        @if(isset($wide) && $wide)
        <div class="container-fluid">
        @else
        <div class="container">
        @endif
        <a class="navbar-brand" href="{{-- {{route('index')}} --}}"><i class="fas fa-chart-line"></i> {{config('app.name')}}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{route('rounds.listing')}}">Rounds</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('deaths.listing')}}">Deaths</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('me')}}">Me</a>
            </li>
          </ul>
          @auth
              <p class="navbar-text">Logged in!</p>
          @else
              <p class="navbar-text">Not logged in!</p>
          @endauth
        </div>
      </div>
      </nav>
        @if(isset($wide) && $wide)
        <div class="container-fluid">
        @else
        <div class="container">
        @endif
            @yield('content')
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
    </body>
</html>