@extends('layouts.app')

@section('content')
    <div class="title" style="padding-top: 25px">
        {{ $post->title }}
    </div>

    <div class="box">

        {!! $post->content !!}

        {{--@include('posts._leadbox', ['post_id' => $post->id])--}}
    </div>

@endsection
