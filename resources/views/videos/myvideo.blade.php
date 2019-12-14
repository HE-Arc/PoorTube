@extends('videos.layout')

@section('content')

@section('navbar')
<a class="navbar-item navbar-item" href="{{ route('videos.index') }}">
  All videos
</a>
@endsection

@section('delete')

@csrf
@method('DELETE')
<a class="card-footer-item has-text-danger" onclick="document.getElementById('destroy-form').submit();">
  <i class="far fa-times-circle icon is-medium"></i>
  
</a>

@endsection