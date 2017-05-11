@extends('layouts.app')

@section('content')
    <div class="box">
        @foreach($posts as $post)

            <article class="media">
                <div class="media-content">
                    <div class="content">
                        <p>
                            <strong>{{ $post->title }}</strong>
                            <small>{{ $post->user->name }}</small>
                            <br>
                            {{ $post->excerpt }}
                        </p>
                    </div>
                </div>
            </article>


            <a href="{{ route('posts.show', ['post' => $post->id]) }}">Read more</a>

        @endforeach
    </div>
@endsection
