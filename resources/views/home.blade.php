@extends('layouts.app')

@section('content')
    <div class="container-fluid text-white">
        <div class="row m-3">
            <div class="col">
                <div>
                    @if ($path)
                        <h1>Home/{{ $path }}</h1>
                    @else
                        <h1>Home</h1>
                    @endif
                </div>
                <div>
                    @if ($files->count())
                        <div class="row">
                            <button class="btn btn-primary mr-2" onclick="document.getElementById('upload').click()">
                                Upload file
                            </button>
                            <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                                New directory
                            </button>
                            @if ($parent)
                                <button class="btn btn-primary" onclick="window.location='{{ route('home', $parent) }}';">
                                    Go up a level
                                </button>
                            @elseif ($path)
                                <button class="btn btn-primary" onclick="window.location='{{ route('home') }}';">
                                    Go up a level
                                </button>
                            @endif
                            <form action="{{ route('home') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="folder" value="{{ $path }}">
                                <div class="form-group">
                                    <input class="invisible" type="file" name="upload" class="form-control-file" id="upload"
                                        onchange="this.form.submit()">
                                </div>
                            </form>

                        </div>


                        <div class="mt-5">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Type</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Added</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($files as $file)
                                        <tr onclick="window.location='{{ route('check', $file->id) }}';">
                                            <th class="table-data" scope="row">
                                                @if ($file->type == 'DIR')
                                                    Directory
                                                @else
                                                    File
                                                @endif
                                            </th>
                                            <td class="table-data">{{ $file->name }}</td>
                                            <td class="table-data">
                                                @if ($file->size)
                                                    {{ $file->size }}
                                                @endif
                                            </td>
                                            <td class="table-data">{{ $file->created_at }}</td>
                                            <td><a href="{{ route('home.delete', $file->id) }}">Delete</a></td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @else
                        <p>You have no files yet</p>
                        <button class="btn btn-primary mr-2" onclick="document.getElementById('upload').click()">
                            Click here to upload one
                        </button>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Or make a new directory
                        </button>
                        @if ($parent)
                            <button class="btn btn-primary" onclick="window.location='{{ route('home', $parent) }}';">
                                Go up a level
                            </button>
                        @elseif ($path)
                            <button class="btn btn-primary" onclick="window.location='{{ route('home') }}';">
                                Go up a level
                            </button>
                        @endif
                        <form action="{{ route('home') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="folder" value="{{ $path }}">
                            <div class="form-group">
                                <input class="invisible" type="file" name="upload" class="form-control-file" id="upload"
                                    onchange="this.form.submit()">
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade text-white" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-dark">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">New Directory</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('home.new.dir') }}" method="post" class="form">
                    @csrf
                    <input type="hidden" name="folder" value="{{ $path }}">
                    <div class="modal-body bg-dark">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" id="name">
                        </div>
                    </div>
                    <div class="modal-footer bg-dark">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
