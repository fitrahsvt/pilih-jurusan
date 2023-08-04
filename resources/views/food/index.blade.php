@extends('layouts.main')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="my-4">Foods</h1>
        <a href="{{route('food.create')}}" class="btn btn-primary mb-2">Add Food</a>
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($food as $f)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $f->name }}</td>
                                <td>Rp. {{number_format($f->price, 0, 2) }}</td>
                                <td>{{ $f->description }}</td>
                                <td>
                                    <form action="{{route('food.destroy', $f->id)}}" method="POST" onsubmit="return confirm('Anda yakin menghapus ini?');">
                                        <a type="button" class="btn btn-warning" href="{{route('food.edit', $f->id)}}">Edit</a>
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
