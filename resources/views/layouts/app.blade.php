<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.1/css/bulma.css" rel="stylesheet" />
        <link href="{{ asset('css/wp.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="content">
                @yield('content')
            </div>
        </div>

        <script src="https://unpkg.com/vue@2.1.3/dist/vue.js"></script>
        <script src="main.js"></script>
    </body>
</html>
