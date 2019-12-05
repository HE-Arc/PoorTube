@extends('videos.layout')

@section('content')

<!-- START NAVBAR -->
<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="">
      <img src="/icon/logo.png" width="112" height="28">
    </a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          @if (Route::has('login'))
          @auth
          <a href="">Logout</a><!-- TODO -->
          @else
          <a href="{{ route('login') }}" class="button is-light">
            Log in
          </a>
          @if (Route::has('register'))
          <a href="{{ route('register') }}" class="button is-primary">
            <strong>Sign up</strong>
          </a>
          @endif
          @endauth
          <a class="button is-light" href="{{ route('videos.create') }}">
            <i class="fas fa-plus icon is-medium"></i>
          </a>
          @endif
        </div>
      </div>
    </div>
  </div>
</nav>
<!-- END NAVBAR -->

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif

<!-- START VIDEOS -->
<section class="articles">
  <div class="column is-8 is-offset-2">

    @foreach ($videos as $video)

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
    @endforeach
  </div>
</section>
<!-- END VIDEOS -->


@endsection