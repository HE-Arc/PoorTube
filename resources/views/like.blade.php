@extends('layouts.app')

@section('content')
<div class="body">
  @inject('liker', 'App\Http\Controllers\LikeController')
  @foreach($videos as $key => $data)
    {{ 1 }}
    //<!--<a href="{{ $liker::store(1, $data->id+1) }}" class="btn btn-xs btn-info pull-right">+</a>-->
    <a href="{{ url('/like/add/1/1') }}" class="btn btn-xs btn-info pull-right">+</a>
    <a href="{{ url('/like/remove/1/1') }}" class="btn btn-xs btn-info pull-right">-</a>
  @endforeach
</div>
@endsection
