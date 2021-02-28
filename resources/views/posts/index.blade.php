@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <a class="btn btn-primary" href="{{ route('posts.create') }}">新規投稿</a>
      @foreach ($posts as $post)
      <div class="card">
        <div class="card-header">
          <a href="{{ action('PostController@show', $post->id) }}">{{ $post->title }}</a>
        </div>

        <div class="card-body">
          <p class="card-text">
            {{ $post->body }}
          </p>
        </div>
        <div class="card-footer">
          投稿日時: {{ $post->created_at }} <br>
          投稿者: {{ $post->user->name }}
        </div>
      </div>
      @endforeach
    </div>
    {{ $posts->links() }}
  </div>
</div>
@endsection