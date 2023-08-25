@extends('layout.app')
@extends('layout.navbar')

@section('content')
<div class="container">
    <div class="row justify-content-evenly">
        <h2 class="text-center mt-4">Update a user</h2>
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row justify-content-evenly">
                <div class="col-6 mt-3">
                    <div class="form-floating mb-3">
                        <select class="form-select" name="role" id="floatingSelect" aria-label="Floating label select example">
                          <option selected disabled>-- Select Role --</option>
                          @foreach ( $roles as $role )
                          <option value="{{ $role->id }}" @selected($user->role_id == $role->id)>{{ $role->name }}</option>
                          @endforeach
                        </select>
                        @error('role')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="floatingSelect">Role</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="firstname" value="{{ $user->person->firstname }}" class="form-control" id="floatingInput" placeholder="Firstname">
                        @error('firstname')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="floatingInput">Firstname</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="middlename" value="{{ $user->person->middlename }}" class="form-control" id="floatingPassword" placeholder="Middlename">
                        @error('middlename')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="floatingPassword">Middlename</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="lastname" value="{{ $user->person->lastname }}" class="form-control" id="floatingPassword" placeholder="Lastname">
                        @error('lastname')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="floatingPassword">Lastname</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="suffix" value="{{ $user->person->suffix }}" class="form-control" id="floatingPassword" placeholder="Suffix">
                        @error('suffix')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="floatingPassword">Suffix</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" name="birthdate" value="{{ $user->person->birthdate }}" class="form-control" id="floatingPassword" placeholder="Birthdate">
                        @error('birthdate')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="floatingPassword">Birthdate</label>
                    </div>
                </div>
                <div class="col-6 mt-3">
                    <div class="form-floating mb-3">
                        <input type="text" name="username" value="{{ $user->username }}" class="form-control" id="floatingInput" placeholder="Username">
                        @error('username')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="floatingInput">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="email" value="{{ $user->email }}" class="form-control" id="floatingInput" placeholder="Email">
                        @error('email')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" id="floatingInput" placeholder="Phone">
                        @error('phone')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="floatingInput">Phone</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="floatingInput" placeholder="Password">
                        @error('password')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="floatingInput">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password_confirmation" class="form-control" id="floatingInput" placeholder="Confirm Password">
                        <label for="floatingInput">Confirm Password</label>
                    </div>
                </div>
            </div>
            <div class="container text-center">
                <button type="submit" class="btn btn-primary me-1">Update</button>
                <a class="btn btn-danger ms-1" role="button" href="{{ route('users.create') }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection