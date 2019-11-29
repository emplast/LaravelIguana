<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Album</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <script type="text/javascript" src="{{asset('dist/js/bootstrap.min.js')}}"></script>
        <!-- Styles -->
        <style>
        html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100%;
        margin: 0;
        }
        .full-height {
        height: 100%;
        }
        .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
        }
        .position-ref {
        position: relative;
        }
        .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
        }
        .content {
        text-align: center;
        }
        .title {
        font-size: 84px;
        }
        .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
        }
        .m-b-md {
        margin-bottom: 30px;
        }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            @if (Route::has('login'))
            <div class="top-right links">
                @auth
                <a href="{{ url('/home') }}">Home</a>
                @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
            @endif
        </div>
        <br/><br/><br/>
        <p class="text-center">Zaloguj się możesz utworzyć swój własny katalog i dodawać komentarze i będziesz miał dostęp do wszystkich albumów</p>
        <br/>
        <br/>
        <br/>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                
               <?php $i=0; foreach($albums as $album):?>
                <?php  if($i<6):?>
                    <div class="col-sm-6 col-md-4" style="height: 500px;">
                        <div class="thumbnail">
                            <img src="{{asset($album->adres)}}" alt="..." width="300" height="300">
                            <div class="caption">
                                <h3>{{ $album->name}}</h3>
                                <p>{{ $album->opis}}</p>
                                <p>{{ $album->autor}}</p>
                            </div>
                        </div>
                    </div>
               <?php  $i=$i+1;endif; endforeach;?>
                    
                
            </div>
            
            <div class="col-sm-1"></div>
        </div>
    
</body>
</html>