@extends('layouts.main')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="my-4">Category</h1>
        @if (Auth::user()->role->name == 'admin')
        <a href="{{route('category.create')}}" class="btn btn-primary mb-2">Create New</a>
        @endif
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            @if (Auth::user()->role->name == 'admin')
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $c)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$c['name']}}</td>
                            @if (Auth::user()->role->name == 'admin')
                            <td>
                                <form action="{{route('category.destroy', $c->id)}}" method="POST" onsubmit="return confirm('Anda yakin menghapus ini?');">
                                    <a type="button" class="btn btn-warning" href="{{route('category.edit', $c->id)}}">Edit</a>
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
