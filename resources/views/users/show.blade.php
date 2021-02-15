@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        @foreach ($user as $user_data)
          <div class="card-header">
            {{ $user_data->user->name }}
          </div>

          <div class="card-body">
            <p class="card-text">
              {{ $user_data->user->role }}
            </p>
          </div>

          <div class="card-footer">
            登録日時: {{ $user_data->user->created_at }}
          </div>

          <div class="card-header">
            {{ $user_data->title }}
          </div>
          
          <div class="card-body">
            <p class="card-text">
              {{ $user_data->body }}
            </p>
          </div>

          <div class="card-footer">
            投稿日時: {{ $user_data->created_at }}
          </div>
        @endforeach
      </div>
      
    </div>
  </div>
</div>
@endsection