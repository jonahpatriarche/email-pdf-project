<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

<!-- Styles -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.1/css/bulma.css" rel="stylesheet" />
<link href="{{ asset('css/wp.css') }}" rel="stylesheet">

    <div class="title" style="padding-top: 25px">
        {{ $post->title }}
    </div>

    <div class="box">
        {!! $post->content !!}
    </div>

