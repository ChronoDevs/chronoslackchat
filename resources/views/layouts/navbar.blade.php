@section('navbar')
    <nav class="navbar navbar-expand-lg p-0">
        <div class="container-fluid p-0">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="row align-items-center w-100">
                    <div class="col">
                        <div class="d-flex d-flex justify-content-start">
                            <div class="channel-search">
                                <div class="row m-0">
                                    <div class="col p-0">
                                        <form role="search">
                                            <div class="input-group">
                                                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                                                <input type="search" class="form-control border-start-0" name="search" placeholder="Search">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        @auth
                        <div class="d-flex align-items-center justify-content-end">
                            <a role="button" class="text-decoration-none text-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="dropdown">
                                    <div class="d-flex">
                                        <div class="row">
                                            <div class="col align-self-center">
                                                <img src="{{ asset('storage/img/default-profile-pic.jpg') }}" width="50" height="50" class="user-avatar img-fluid rounded-circle" alt="Auth User Image">
                                            </div>
                                        </div>
                                        <div class="user-dropdown row flex-column m-auto">
                                            <div class="col fw-semibold">{{ Auth::user()->person->firstname }} {{ Auth::user()->person->lastname }}</div>
                                            <div class="col">{{ Auth::user()->role->name }}</div>
                                        </div>
                                    </div>
                                    <ul class="dropdown-menu mt-2">
                                        @if (Auth::user()->role_id == config('const.user_role.admin'))
                                            <li><a class="dropdown-item" href="{{ route('web.users.create') }}">Users</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                        @endif
                                        <li><a class="dropdown-item" href="{{ route('web.profile.edit', Auth::user()) }}">Profile</a></li>
                                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endsection