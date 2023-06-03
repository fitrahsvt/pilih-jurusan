@extends('layouts.main')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="my-4">Create User</h1>

            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{route('user.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select @error('role') is-invalid @enderror" aria-label="role" name="role" id="role">
                                <option selected disabled>- Choose Role -</option>
                                @foreach ($role as $r)
                                    <option value="{{$r->id}}" {{old('role') == $r->id ? 'selected' : ''}}>{{$r->name}}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name')}}" name="name" required>
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{old('email')}}" name="email" required>
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" value="{{old('password')}}" name="password" required>
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{old('phone')}}" name="phone">
                            @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
