@extends('videos.layout')

@section('content')

<div class="column is-8 is-offset-2">

    <!-- <div class="pull-right">
        <a class="button is-link is-light" href="{{ route('videos.index') }}"> Back</a>
    </div> -->

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
                <button class="button is-link is-light" href="{{ route('videos.index') }}">Cancel</button>
            </div>
        </div>

        

    </form>
</div>

<!-- <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Video</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('videos.index') }}"> Back</a>
        </div>
    </div>
</div>
   
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
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Video:</strong>
                <input type="file" name="video" class="form-control">
            </div>
        </div> -->
<!-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Public:</strong>
                <input type="text" name="public">
            </div>
        </div> -->
<!-- <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div> -->

<!-- <div class="row">

                <div class="col-md-5">

                    <strong>Title:</strong>

                    <input type="text" name="name" class="form-control" placeholder="Title">

                </div>

                <div class="col-md-5">

                    <strong>Video:</strong>

                    <input type="file" name="video" class="form-control">

                </div>

                <div class="col-md-2">

                    <br />

                    <button type="submit" class="btn btn-success">Upload</button>

                </div>

            </div> -->

<!-- </form> -->
@endsection