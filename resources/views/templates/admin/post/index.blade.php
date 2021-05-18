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
    @if (session('success'))
        <div id="msg" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @endif
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
                    <th scope="col">Confirmed</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if($items->total() > 0)
                    @foreach($items as $item)
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->content }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td class="ajax-response">{{ $item->confirmed }}</td>
                            <td>
                                <form action="{{ route('admin.post.destroy',$item->id ) }}" method="POST">
                                    <a class="btn btn-secondary"
                                       href="{{ route('admin.post.edit',$item->id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    <a class="btn btn-secondary" href="{{ route('admin.post.confirm') }}"
                                       data-handler="confirmRow" data-id="{{$item->id}}">Confirm</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr aria-colspan="8" >
                        <td colspan="8">
                            <div class="alert alert-danger text-center" role="alert">
                                Empty list
                            </div>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        {{ $items->links() }}
    </div>


@endsection

@section('scripts')
    <script type="text/javascript">

        $(document).ready(function () {
            $(document).on('click', '[data-handler="confirmRow"]', function (e) {
                e.preventDefault(); //зупиняє стандартний обработчик
                var that = $(this), url = that.attr('href'),
                    id = that.data('id');
                if (typeof url === 'string' && url.length > 0) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {id: id},
                        headers: {
                            'X-CSRF-Token': "{{ csrf_token() }}",
                        },
                        dataType: 'json',
                        success: function (response) {
                            if(response.success){
                                //window.location.reload();
                                var rowEl = that.closest('tr');

                                rowEl.find('.ajax-response').text(1);

                            }

                        }
                    });
                } else {
                    throw new Error('Attribute href must be set!');
                }
            });
        });


    </script>
@endsection
