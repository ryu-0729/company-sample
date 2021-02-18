@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @foreach ($soft_delete_users as $soft_delete_user)
      <div class="card">
        <div class="card-header">
          {{ $soft_delete_user->name }}
        </div>

        <div class="card-body">
          <p class="card-text">
            <a href="{{ action('AdminController@restore', $soft_delete_user->id) }}" class="btn btn-secondary" type="button">復元する</a>
            <a href="{{ action('AdminController@delete', $soft_delete_user->id) }}" class="btn btn-secondary" type="button">完全に削除する</a>
          </p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection