@extends('videos.layout')

@section('navbar')
<a class="navbar-item navbar-item" href="{{ route('videos.allVideos') }}">
  Your videos
</a>
@endsection