@extends('layouts.app')

@section('content')
    <div class="container-fluid text-white">
        <div class="row mt-5">
            <div class="col-6 mx-auto">
                <div>
                    <p>{{$name}}</p>
                </div>
                <div>
                    <video class="embed-responsive" controls autoplay>
                        <source src="{{route('display.load', $id)}}">
                        Your browser does not support this video.
                    </video>
                </div>
                <div class="row no-gutters mt-1">
                    <a class="btn btn-primary" href="{{route('display.download', $id)}}">Download video</a>
                </div>
            </div>
        </div>
    </div>

@endsection
