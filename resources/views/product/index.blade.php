ini halaman product
@extends('layouts.main')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="my-4">Product</h1>
        @if (Auth::user()->role->name == 'admin')
        <a href="{{route('product.create')}}" class="btn btn-primary mb-2">Create New</a>
        @endif
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Sale Price</th>
                            <th>image</th>
                            <th>Brand</th>
                            @if (Auth::user()->role->name == 'admin')
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $p)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$p->category->name}}</td>
                                <td>{{$p->name}}</td>
                                <td>Rp. {{number_format($p->price, 0, 2) }}</td>
                                <td>Rp. {{number_format($p->sale_price, 0, 2) }}</td>
                                <td>
                                    @if ($p->image == null)
                                    <span class="badge bg-primary">No Image</span>
                                @else
                                <img src="{{ asset('storage/product/' . $p->image) }}" class="img-fluid" style="max-width: 100px;" alt="{{ $p->image }}">
                                @endif
                                </td>
                                <td>{{$p->brands}}</td>
                                @if (Auth::user()->role->name == 'admin')
                                <td>
                                    <form action="{{route('product.destroy', $p->id)}}" method="POST" onsubmit="return confirm('Anda yakin menghapus ini?');">
                                        <a type="button" class="btn btn-warning" href="{{route('product.edit', $p->id)}}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
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
