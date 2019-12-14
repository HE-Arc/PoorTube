<!DOCTYPE html>
<html>

<head>
    <title>PoorTube</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>

<body>

    <div class="container">
        <div class="column is-8 is-offset-2">

            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="field">
                    <label class="label">Name</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="Text input" name="name">
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <strong>Video:</strong>
                        <div class="file">
                            <label class="file-label">
                                <input class="file-input" type="file" name="video">
                                <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label">
                                        Choose a file…
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label class="checkbox">
                            <input type="checkbox" name="public">
                            Public
                        </label>
                    </div>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-link">Submit</button>
                    </div>
                    <div class="control">
                        <a class="button is-link is-light" href="{{ url()->previous() }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>