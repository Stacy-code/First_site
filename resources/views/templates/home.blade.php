@extends('layouts.default')
@section('title' , 'Home')
@section('content')
    <div class="conteiner-fluid">

        <div class="row justify-content-center">
            <div class="col-lg-4">
        <?php if (!empty($callbackItems)) : ?>

        <div id="carouselExampleControls" class="carousel slide " data-ride="carousel">
            <div class="carousel-inner">
                <?php $step = 0; ?>
                <?php foreach ($callbackItems as $item) : ?>
                <?php $itemClass = $step > 0 ? 'carousel-item' : 'carousel-item active'?>
                <div class="<?= $itemClass ?>">
                    <img class="d-block w-100" src="{{url('/public/images/grey.jpg')}}" alt="Slide: <?= $step ?>">
                    <div class="carousel-caption d-none d-md-block">

                        <h5 >{{$item['name']}}</h5>
                        <p>{{$item['content']}}</p>
                        <p>{{$item['created_at']}}</p>

                    </div>

                </div>
                <?php ++$step ?>

                <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>


        <?php endif; ?>
            </div>
        </div>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="row justify-content-center mt-5 " >
        <form  class="col-lg-4 border  rounded shadow p-3 mb-5 bg-white rounded"  method="POST" action="{{ route('callback') }}">
            @csrf
            <div class="form-group " >
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="content">Message</label>
                <textarea  class="form-control" id="content" name="content" >{{ old('content') }}</textarea>

            </div>


            <button type="submit"  name="save" class="btn btn-primary">Submit</button>
        </form>
            </div>
    </div>

@endsection
