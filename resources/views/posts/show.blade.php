@extends('layouts.app')

@section('content')

    <div class="title" style="padding-top: 25px">
        {{ $post->title }}
    </div>

    <div class="box">

        {!! $post->content !!}

        {{--@include('posts._leadbox', ['post_id' => $post->id])--}}
    </div>

    <div class="box">
        {{ Form::open(['route' => 'posts.email']) }}

        {{ Form::hidden('post_id', $post->id) }}

        {{ Form::label('email', 'Email PDF of this post') }}
        {{ Form::email('email') }}

        {{ Form::submit('Send', ['class' => 'button is-success']) }}

        {{ Form::close() }}

    </div>
@endsection
