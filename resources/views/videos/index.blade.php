@extends('videos.layout')

@section('navbar')
<a class="navbar-item navbar-item" href="{{ route('videos.myVideos') }}">
  Your videos
</a>
@endsection