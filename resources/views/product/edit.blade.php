@extends('layouts.main')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="my-4">Edit Product</h1>

            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{route('product.update', $product->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>

                            <select class="form-select" aria-label="category" name="category" id="category">
                                <option selected disabled>- Choose Category -</option>
                                @foreach ($category as $c)
                                    <option value="{{$c->id}}" {{ $product->category_id == $c->id ? 'selected' : '' }}>{{$c->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input value="{{$product->name}}" type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input value="{{$product->price}}" type="text" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="sale_price" class="form-label">Sale Price</label>
                            <input value="{{$product->sale_price}}" type="text" class="form-control" id="sale_price" name="sale_price">
                        </div>
                        <div class="mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <select class="form-select" aria-label="brand" name="brand" id="brand">
                                <option selected disabled>- Choose Brand -</option>
                                @foreach ($brand as $b)
                                    <option value="{{$b->name}}" {{ $product->brands == $b->name ? 'selected' : '' }}>{{$b->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{route('product.index')}}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
