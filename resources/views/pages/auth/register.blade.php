@extends('layout.app')
@extends('layout.navbar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h2 class="text-center mt-4">Create a user</h2>
        @if (session()->has('success'))
        <div class="alert alert-success d-flex justify-content-center" role="alert"><i class="bi bi-check-circle-fill me-1"></i>{{ session('success') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-hover text-center mt-3">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Role</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Middlename</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr class="align-middle">
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->person->firstname }}</td>
                        <td>{{ $user->person->middlename }}</td>
                        <td>{{ $user->person->lastname }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-sm btn-primary me-1" href="{{ route('users.edit', $user) }}" role="button"><i class="bi bi-pencil"></i></a>
                                <form class="ms-1" action="{{ route('users.destroy', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete {{ $user->email }}?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <p>No users available.</p>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">{{ $users->links() }}</div>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="row justify-content-evenly">
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <select class="form-select" name="role" id="floatingSelect" aria-label="Floating label select example">
                          <option selected disabled>-- Select Role --</option>
                          @foreach ( $roles as $role )
                          <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                          @endforeach
                        </select>
                        @error('role')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="floatingSelect">Role</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="firstname" value="{{ old('firstname') }}" class="form-control" id="floatingInput" placeholder="Firstname">
                        @error('firstname')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="floatingInput">Firstname</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="middlename" value="{{ old('middlename') }}" class="form-control" id="floatingPassword" placeholder="Middlename">
                        @error('middlename')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="floatingPassword">Middlename</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="lastname" value="{{ old('lastname') }}" class="form-control" id="floatingPassword" placeholder="Lastname">
                        @error('lastname')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="floatingPassword">Lastname</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="suffix" value="{{ old('suffix') }}" class="form-control" id="floatingPassword" placeholder="Suffix">
                        @error('suffix')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="floatingPassword">Suffix</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" name="birthdate" value="{{ old('birthdate') }}" class="form-control" id="floatingPassword" placeholder="Birthdate">
                        @error('birthdate')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="floatingPassword">Birthdate</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" name="username" value="{{ old('username') }}" class="form-control" id="floatingInput" placeholder="Username">
                        @error('username')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="floatingInput">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="floatingInput" placeholder="Email">
                        @error('email')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="floatingInput" placeholder="Phone">
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
                <div class="container text-center">
                    <button type="submit" class="btn btn-primary me-1">Submit</button>
                    <a class="btn btn-danger ms-1" role="button" href="{{ route('web.channels.index') }}">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection