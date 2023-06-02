@extends('layouts.main')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="my-4">Role</h1>
        @if (Auth::user()->role->name == 'admin')
        <a href="{{route('role.create')}}" class="btn btn-primary mb-2">Create New</a>
        @endif
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $r)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$r['name']}}</td>
                            <td>
                                <form action="{{route('role.destroy', $r->id)}}" method="POST" onsubmit="return confirm('Anda yakin menghapus ini?');">
                                    <a type="button" class="btn btn-warning" href="{{route('role.edit', $r->id)}}">Edit</a>
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
