@extends('layouts.main')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="my-4">Brand</h1>
            @if (Auth::user()->role->name == 'admin')
            <a class="btn btn-primary mb-2" href="{{ route('brand.create') }}" role="button">Create New</a>
            @endif
            <div class="card mb-4">
                <div class="card-body">
                    <table id="dataTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                @if (Auth::user()->role->name == 'admin')
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $brand->name }}</td>
                                    @if (Auth::user()->role->name == 'admin')
                                    <td>
                                        <form onsubmit="return confirm('Are you sure? ');" action="{{ route('brand.destroy', $brand->id) }}" method="POST">
                                            <a href="{{ route('brand.edit', $brand->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
