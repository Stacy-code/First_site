@extends('layouts.default')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">Edit callback</li>
        </ol>
    </nav>
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
    <div class="row justify-content-center mt-5">
        <form class="col-lg-4" method="post" action="{{ route('admin.callback.update',$callback->id) }}">
            @method('PATCH')
            @csrf
            <div class="form-group ">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp"
                       value="{{ $callback->name }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $callback->email }}">
            </div>
            <div class="form-group">
                <label for="content">Message</label>
                <textarea class="form-control" id="content" name="content">{{ $callback->content }}</textarea>
            </div>
            <button type="submit" name="save" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
