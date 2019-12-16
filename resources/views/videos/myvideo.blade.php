@extends('videos.layout')

@section('content')

@section('navbar')
<a class="navbar-item navbar-item" href="{{ route('videos.index') }}">
  All videos
</a>
@endsection
