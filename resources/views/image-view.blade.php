@extends('layouts.app')

@section('content')
    <div class="container-fluid text-white">
        <div class="row mt-5">
            <div class="col-6 mx-auto">
                <div>
                    <p>{{$name}}</p>
                </div>
                <div>
                    <img class="img-fluid" src="{{route('display.load', $id)}}">
                </div>
                <div class="row no-gutters mt-1">
                    <a class="btn btn-primary mr-1" href="{{route('display.load', $id)}}">View full image</a>
                    <a class="btn btn-primary" href="{{route('display.download', $id)}}">Download image</a>
                </div>
            </div>
        </div>
    </div>

@endsection
