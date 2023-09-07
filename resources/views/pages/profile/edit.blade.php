@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="text-center">Profile Page</h1>
    <h2>Hello, {{ $user->person->firstname }}</h2>
</div>
@endsection