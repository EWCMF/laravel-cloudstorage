@extends('layouts.app')

@section('content')
    <div class="container-fluid text-white">
        <div class="row mt-5">
            <div class="col-6 mx-auto">
                <div>
                    <p>{{$name}}</p>
                </div>
                <div>
                    <audio class="embed-responsive"  controls autoplay>
                        <source src="{{route('display.load', $id)}}" type="{{$type}}">
                            Your browser does not support this audio.
                    </audio>
                </div>
                <div class="row no-gutters mt-1">
                    <a class="btn btn-primary" href="{{route('display.download', $id)}}">Download audio</a>
                </div>
            </div>
        </div>
    </div>

@endsection
