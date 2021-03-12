@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form class="form-inline my-2 my-lg-0 ml-2">
        <div class="form-group">
          <input type="search" class="form-control mr-sm-2" name="search"  value="{{request('search')}}" placeholder="キーワードを入力" aria-label="検索...">
        </div>
        <input type="submit" value="検索" class="btn btn-info">
      </form>
      @foreach ($users as $user)
      <div class="card">
        <div class="card-header">
          <a href="{{ action('UserController@show', $user->id) }}">{{ $user->name }}</a>
        </div>
      </div>
      @endforeach
    </div>
    {{ $users->appends(request()->input())->links() }}
  </div>
</div>
@endsection