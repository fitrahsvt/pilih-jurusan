@extends('layouts.main')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="my-4">User</h1>
        <a href="{{route('user.create')}}" class="btn btn-primary mb-2">Create New</a>
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $u)
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <td>{{$u->name}}</td>
                            <td>{{$u->email}}</td>
                            <td>
                                <form action="{{route('user.destroy', $u->id)}}" method="POST" onsubmit="return confirm('Anda yakin menghapus ini?');">
                                    <a type="button" class="btn btn-warning" href="{{route('user.edit', $u->id)}}">Edit</a>
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
