@extends('layouts.app')
{{-- @extends('layouts.navbar') --}}

@section('content')
<div class="container-fluid">
    <h2 class="text-center mt-4">Create a channel</h2>
    @if (session()->has('success'))
        <div class="alert alert-success text-center" role="alert">{{ session('success') }}</div>
    @endif
    <div class="row justify-content-center">
      <div class="col col-sm-4">
        <form action="{{ route('web.channels.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Avatar</label>
                <input class="form-control" type="file" name="avatar" id="formFile">
                @error('avatar')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="container text-center">
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <a class="btn btn-danger" role="button" href="{{ route('web.channels.index') }}">Cancel</a>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection