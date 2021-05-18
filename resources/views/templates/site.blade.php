@extends('layouts.partials.header')
@section('title' , 'Site')
@section('content')
<div class="conteiner-fluid">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form  method="POST" action="{{ route('site') }}">
        @csrf
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="author">Автор</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}">
        </div>
        <div class="form-group">
            <label for="content">Контент</label>
            <textarea  class="form-control" id="content" name="content" >{{ old('content') }}</textarea>

        </div>


        <button type="submit"  name="save" class="btn btn-primary">Сохранить</button>
    </form>
</div>
@extends('layouts.partials.footer')
@endsection
