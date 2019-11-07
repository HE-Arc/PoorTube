@extends('layouts.app')

@section('content')
<div class="body">
  {{$name}}
  <a href="{{ url('/like/add1-1') }}" class="btn btn-xs btn-info pull-right">+</a>
  <a href="{{ url('/like/remove1-1') }}" class="btn btn-xs btn-info pull-right">-</a>
</div>
@endsection
