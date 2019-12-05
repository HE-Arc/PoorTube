@extends('videos.layout')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<!-- VIDEO DISPLAY -->
<div class="card article">
    <div class="card-content">
        <p class="title">
            {{ $video->name }}
        </p>
        <video controls>
            <source src="/videos-gallery/{{ $video->video }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <p class="subtitle">
            Gaël Christe
        </p>
        <a href=""><i class="far fa-heart icon is-medium"></i></a>
        <a href=""><i class="far fa-comment icon is-medium"></i></a>

    </div>
</div>
<!-- END VIDEO DISPLAY -->


@endsection