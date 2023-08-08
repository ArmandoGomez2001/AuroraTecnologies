<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="home.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <div class="main-container">
      <div class="left">
        <div class="text-content">
        <nav class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="logo" width="200">
        </nav>
          <h2>EcoMeter</h2>
          <p>Medición Inteligente para un Hogar Eficiente</p> 
         
        </div>
      </div>

      <div class="right" style="background-color:#000">
        <div class="text-content text-center">
          <h3 class="text-light"><b>Empieza ahora</b></h3>
          @if (Route::has('login'))
            <div class="sm:block align-content">
                @auth
                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                    <!--<button type="button" href="{{ url('/home') }}" class="btn btn-primary">Home</button>-->
                    @else
                    <button type="button" class="btn btn-primary" id="loginButton">Log in</button>
                    <script>
                        $(document).ready(function() {
                            $("#loginButton").on("click", function() {
                                window.location.href = "{{ route('login') }}";
                            });
                        });
                    </script>
                    <!--<button type="button" href="{{ route('login') }}" class="btn btn-primary">Log in</button>-->

                    @if (Route::has('register'))
                        <button class="btn btn-dark" id="registerButton">Register</button>
                        <script>
                        $(document).ready(function() {
                            $("#registerButton").on("click", function() {
                                window.location.href = "{{ route('register') }}";
                            });
                        });
                    </script>
                    @endif
                @endauth
                </div>
            @endif   
        </div>
        <div class="info">
            <div class="py-3 text-xs">
                <a href="#" class="mx-3 text-light" rel="noreferrer">Terms of use</a>
                <span class="text-gray-600">|</span>
                <a href="#" class="mx-3 text-light" rel="noreferrer">Privacy policy</a>
            </div>
        </div>
      </div>
    </div>
  </body>
</html>