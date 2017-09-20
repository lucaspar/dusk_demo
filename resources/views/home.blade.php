<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="/favicon.ico?v=2" />

        <title>{{ config('app.name', 'Dusk Tester') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    </head>
    <body>

        <div id="wrapper">
          <div id="featured">
              <video id="bg-video" muted="true" autoplay="true" loop>
                  <source src="images/weather/timelapse.webm" type="video/webm">
                  <source src="images/weather/timelapse.mp4" type="video/mp4">
                  Seu navegador não suporta a tag de vídeo
              </video>
          </div>
        </div>

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('app') }}">Acessar</a>
                    @else
                        <a href="{{ route('login') }}">Entrar</a>
                        <a href="{{ route('register') }}">Registrar</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{ config('app.name', 'Dusk Tester') }}
                </div>
            </div>
        </div>

    </body>

</html>
