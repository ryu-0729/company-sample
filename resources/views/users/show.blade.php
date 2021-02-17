@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
            {{ $user->name }}
        </div>

        <div class="card-body">
          <p class="card-text">
            {{ $user->role }}
          </p>
        </div>

        <div class="card-footer">
          登録日時: {{ $user->created_at }}
          <div class="row">
            <div class="col-md-offset-2 col-md-8">
              {!! Form::open(['action' => ['UserController@destroy', $user->id], 'method' => 'delete']) !!}
              {{ Form::submit('ユーザーの削除', ['class' => 'btn btn-danger']) }}
              {!! Form::close() !!}
            </div>
          </div>
        </div>
        @foreach ($user_posts as $post)
          <div class="card-header">
            {{ $post->title }}
          </div>
          
          <div class="card-body">
            {{ $post->body }}
          </div>

          <div class="card-footer">
            投稿日時: {{ $post->created_at }}
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection