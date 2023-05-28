ini halaman product
@extends('layouts.main')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="my-4">Product</h1>
        <a href="{{route('product.create')}}" class="btn btn-primary mb-2">Create New</a>
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
                            <th>Brand</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $p)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$p->category->name}}</td>
                                <td>{{$p->name}}</td>
                                <td>Rp. {{number_format($p->price, 0, 2) }}</td>
                                <td>{{number_format($p->sale_price, 0, 2) }}</td>
                                <td>{{$p->brands}}</td>
                                <td>
                                    <form action="{{route('product.destroy', $p->id)}}" method="POST" onsubmit="return confirm('Anda yakin menghapus ini?');">
                                        <a type="button" class="btn btn-warning" href="{{route('product.edit', $p->id)}}">Edit</a>
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
