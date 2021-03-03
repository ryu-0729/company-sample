@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          {{ $post->title }} <br>
          @if ($login_user->id === $post->user->id)
            <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post]) }}">編集</a><br>
          @endif
          投稿者: {{ $post->user->name }}
        </div>

        <div class="card-body">
          <p class="card-text">
            {{ $post->body }}
          </p>
        </div>
        <div class="card-footer">
          投稿日時: {{ $post->created_at }}
            <div class="row">
              @if ($login_user->id === $post->user->id)
                <div class="col-md-offset-2 col-md-8">
                  {!! Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'delete']) !!}
                  {{ Form::submit('削除', ['class' => 'btn btn-danger']) }}
                  {!! Form::close() !!}
                </div>
              @endif
          </div>
        </div>
        @forelse($post->comments as $comment)
          <div class="border-top p-4">
            <div class="card-body">
              <p class="card-text">
                {{ $comment->body }}
              </p>
            </div>
          </div>
        @empty
          <p>コメントはまだありません</p>
        @endforelse
        <div class="col-md-offset-2 col-md-8">
          {!! Form::open(['route' => ['comments.store', $post->id]]) !!}
          {{ Form::label('body', 'コメント', ['class' => 'col-md-3 col-form-label']) }}
          {{ Form::text('body', '', ['class' => 'col-md-9 form-control']) }}
          {{ Form::hidden('post_id', $post->id) }}
          {{ Form::submit('コメントする', ['class' => 'btn btn-primary']) }}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection