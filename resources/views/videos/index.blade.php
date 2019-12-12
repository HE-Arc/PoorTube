@extends('videos.layout')

@section('content')
<!-- START NAVBAR -->
<nav class="navbar">
      <div class="container">
        <div class="navbar-brand">
          <a class="navbar-item" href="{{ route('videos.index') }}">
            <img src="/icon/logo.png" alt="Logo">
          </a>

          <span class="navbar-burger burger" data-target="navbarMenu">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </div>

        <div id="navbarMenu" class="navbar-menu">
          <div class="navbar-end">
            @if (Route::has('login'))
            <a class="navbar-item navbar-item" href="{{ route('videos.allVideos') }}">
              Your videos
            </a>
            @auth
            <a class="navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
            @else
            <a href="{{ route('login') }}" class="navbar-item">
              Log in
            </a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="navbar-item">
              <strong>Sign up</strong>
            </a>
            @endif
            @endauth
            <a class="navbar-item" href="{{ route('videos.create') }}">
              <i class="fas fa-plus"></i>
            </a>
            @endif
          </div>
        </div>
      </div>
    </nav>
    <!-- END NAVBAR -->

    @if ($message = Session::get('success'))
    <div class="notification is-success">
      <p>{{ $message }}</p>
    </div>
    @elseif ($message = Session::get('warning'))
    <div class="notification is-warning">
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
            <!-- Gaël Christe -->
            {{ $video->author }}
          </p>
          <?php
          $exist = false;
          foreach ($likes as $like) {
            if ($like->video_id == $video->id && $like->user_id == Auth::id()) {
              $exist = true;
            }
          }
          ?>
          <div class="card-footer">
            @if ( $exist == true )
            <a href="{{ route('videos.like', $video->id) }}" class="card-footer-item"><i class="fas fa-heart icon is-medium"></i></a>
            @else
            <a href="{{ route('videos.like', $video->id) }}" class="card-footer-item"><i class="far fa-heart icon is-medium"></i></a>
            @endif
            <a href="" class="card-footer-item"><i class="far fa-comment icon is-medium"></i></a>
          </div>
        </div>
      </div>
      <!-- END VIDEO DISPLAY -->
      @endforeach
    </div>
  </section>
  <!-- END VIDEOS -->



@endsection