@extends('layouts.default')
@section('title', 'Create callback')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Головна</a>
            </li>
            <li class="breadcrumb-item active">Список записів</li>
        </ol>
    </nav>
    <div class="container-fluid mt-3">
        <div class="row">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Content</th>
                    <th scope="col">Created_at</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($items))
                    @foreach($items as $item)
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->content }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                @else
                    <tr aria-colspan="4">
                        <td colspan="4">No callbacks</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        {{ $items->links() }}
    </div>
@endsection
