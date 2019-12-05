@extends('videos.layout')

@section('content')
    <!-- <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 6 CRUD Example from scratch - ItSolutionStuff.com</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('videos.create') }}"> Create New Event</a>
            </div>
        </div>
    </div> -->

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
                  <a class="button is-primary">
                    <strong>Sign up</strong>
                  </a>
                  <a class="button is-light">
                    Log in
                  </a>
                  <a class="button is-light" href="{{ route('videos.create') }}">
                    <i class="fas fa-plus icon is-medium"></i>
                  </a>
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
              <form action="{{ route('videos.like', $video->id) }}" method="get">
                <!--<a href="" ><i class="far fa-heart icon is-medium"></i></a>-->
                <input type="submit" name="" value="salut">
              </form>
              <a href=""><i class="far fa-comment icon is-medium"></i></a>

            </div>
          </div>
          @endforeach
          <!-- END VIDEO DISPLAY -->
        </div>
      </section>
      <!-- END VIDEOS -->

    <!-- <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Video</th>
            <th>Duration</th>
            <th>Public</th>
            <th>fk_owner</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($videos as $video)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $video->name }}</td>
            <td>
            <video width="320" height="240" autoplay>
                <source type="video/mp4" src="/videos-gallery/{{ $video->video }}">
            </video>
        </td>
            <td>{{ $video->duration }}</td>
            <td>{{ $video->public }}</td>
            <td>{{ $video->fk_owner }}</td>
            <td>
                <form action="{{ route('videos.destroy',$video->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('videos.show',$video->id) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('videos.edit',$video->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>-->

    {!! $videos->links() !!}

@endsection
