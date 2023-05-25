@extends('layouts.main')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="my-4">User</h1>
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Avatar</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <td><img src="#" height="50" width="50"/></td>
                            <td>yaya</td>
                            <td>yaya@gmail.com</td>
                            <td>0876283</td>
                            <td>admin</td>
                            <td><a type="button" class="btn btn-primary" href="#">Detail</a>
                                <a type="button" class="btn btn-warning" href="#">Edit</a>
                                <a type="button" class="btn btn-danger" onclick="#">Hapus</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
