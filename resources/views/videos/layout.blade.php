<!DOCTYPE html>
<html>

<head>
    <title>PoorTube</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/poortube.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>

<body>
    <?php

    use Illuminate\Support\Facades\DB;

    ?>

    <div class="container">
        <!-- START NAVBAR -->
        <nav class="navbar">
            <div class="container">
                <div class="navbar-brand">
                    <a class="navbar-item" href="{{ route('videos.index') }}">
                        <img src="{{asset('/icon/logo.PNG')}}" alt="Logo">
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

                        @yield('navbar')

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
            <div class="column">
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
                            $nbLikes = 0;
                            foreach ($likes as $like) {
                                if ($like->video_id == $video->id && $like->user_id == Auth::id()) {
                                    $exist = true;
                                }
                                if ($like->video_id == $video->id) {
                                    $nbLikes++;
                                }
                            }

                            ?>
                            <form id="destroy-form" action="{{ route('videos.destroy',$video->id) }}" method="POST">
                                <div class="card-footer">
                                    @if ( $exist == true )
                                    <a href="{{ route('videos.like', $video->id) }}" class="card-footer-item is-size-3"><i class="fas fa-heart icon is-medium"></i>&nbsp; {{$nbLikes}}</a>
                                    @else
                                    <a href="{{ route('videos.like', $video->id) }}" class="card-footer-item is-size-3"><i class="far fa-heart icon is-medium"></i>&nbsp; {{$nbLikes}}</a>
                                    @endif

                                    @if($video->fk_owner == Auth::id())

                                    @csrf
                                    @method('DELETE')
                                    <a class="card-footer-item has-text-danger" onclick="closest('form').submit();">
                                        <i class="far fa-times-circle icon is-medium"></i>
                                    </a>
                                    @endif

                                </div>
                            </Form>
                        </div>


                    </div>
                    <!-- NEW COMMENT -->
                    <div class="card article card-content">
                        <form action="{{ route('videos.storeComment')}}" method="POST">
                            {!! csrf_field() !!}
                            <article class="media">
                                <input type="hidden" name="video_id" value="{{ $video->id }}">
                                <div class="media-content">
                                    <p class="control">
                                        <input name="comment" class="input" placeholder="Add a comment..."></input>
                                    </p>
                                </div>
                                <div class="media-right media-bottom">
                                    <div class="level-item">
                                        <button type="submit" class="button is-info">Submit</button>
                                        <!-- <a class="button is-info">Submit</a> -->
                                    </div>
                                </div>
                            </article>
                        </form>

                        <br>
                        <!-- END NEW COMMENT -->

                        <!-- OLD COMMENT -->
                        <?php
                        $comments = DB::select('select * from comments where video_id = ? order by created_at DESC LIMIT 3', [$video->id])
                        ?>
                        @foreach($comments as $comment)

                        <article class="media comments">
                            <div class="comments">
                                <div class="media-left">
                                    <p class=" comment subtitle is-6 has-text-weight-semibold">
                                        {{ $comment->user_name }} :
                                    </p>
                                </div>
                                <div class="media-content">
                                    <p class="control subtitle is-6">
                                        {{ $comment->comment }}
                                    </p>
                                </div>
                                @if($comment->user_id == Auth::id())
                                <div class="media-right">
                                    <a href="{{ route('videos.deleteComment', $comment->id)}}" class="card-footer-item has-text-danger">
                                        <i class="far fa-times-circle icon is-medium"></i>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </article>

                        @endforeach

                    </div>
                    <!-- END OLD COMMENT -->

                </div>
                <!-- END VIDEO DISPLAY -->
                @endforeach
            </div>
        </section>
        <!-- END VIDEOS -->

        <script src="/js/bulma.js"></script>

        <script src='https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.9.1/js/OverlayScrollbars.min.js'></script>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            //The first argument are the elements to which the plugin shall be initialized
            //The second argument has to be at least a empty object or a object with your desired options
            OverlayScrollbars(document.querySelectorAll("body"), {});
        });
        </script>
    </div>

</body>

</html>
