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
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection