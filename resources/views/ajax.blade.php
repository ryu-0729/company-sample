@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div id="app" class="card">
        <div class="card-header">
          <div class="card-body">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
  new Vue({
    el: '#app',
    mounted() {
      var url = 'ajax/user';
      axios.get(url).then(function(response){
        var users = response.data;
        console.log(users);
      });
    }
  });
</script>
@endsection
