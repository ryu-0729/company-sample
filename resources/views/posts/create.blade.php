@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">新規投稿</div>

        <div class="card-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          {!! Form::open(['action' => ['PostController@store'], 'method' => 'post']) !!}

          <div class="form-group row">
            {{ Form::label('title', 'タイトル', ['class' => 'col-md-3 col-form-label']) }}
            {{ Form::text('title', '', ['class' => 'col-md-9 form-control']) }}
          </div>
          <div class="form-group row">
            {{ Form::label('body', '内容', ['class' => 'col-md-3 col-form-label']) }}
            {{ Form::text('body', '', ['class' => 'col-md-9 form-control']) }}
          </div>
          {{ Form::submit('新規投稿', ['class' => 'btn btn-primary']) }}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection