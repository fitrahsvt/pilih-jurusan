@extends('layouts.main')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="my-4">Slider</h1>
        <a href="{{route('slider.create')}}" class="btn btn-primary mb-2">Create New</a>
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Caption</th>
                            <th>Image</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $s->title }}</td>
                                <td>{{ $s->caption }}</td>
                                <td>
                                    <img src="{{ asset('storage/slider/' . $s->image) }}" class="img-fluid" style="max-width: 100px;" alt="{{ $s->image }}">
                                </td>
                                <td>
                                    <form action="{{route('slider.destroy', $s->id)}}" method="POST" onsubmit="return confirm('Anda yakin menghapus ini?');">
                                        <a type="button" class="btn btn-warning" href="{{route('slider.edit', $s->id)}}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
