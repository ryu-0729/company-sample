@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @foreach ($users as $user)
      <div class="card">
        <div class="card-header">
          {{ $user->name }}
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection