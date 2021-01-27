@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          {{ $post->title }} | <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post]) }}">編集</a>
        </div>

        <div class="card-body">
          <p class="card-text">
            {{ $post->body }}
          </p>
        </div>
        <div class="card-footer">
          投稿日時: {{ $post->created_at }}
          <div class="row">
            <div class="col-md-offset-2 col-md-8">
              {!! Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'delete']) !!}
              {{ Form::submit('削除', ['class' => 'btn btn-danger']) }}
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection