@extends('layouts.sidebar')
@section('navbar')
  @include('layouts.navbar')
@endsection
@section('page')

<div class="chat-container d-flex flex-column container-fluid">

  <div class="chat-header mt-2 p-2">
    <div class="row gx-0 row-cols-3 align-items-center">
      <div class="col-auto">
        <img src="{{ asset('storage/img/default-profile-pic.jpg') }}" width="50" height="50"  class="img-fluid rounded-circle" alt="default-avatar">
      </div>
      <div class="col-auto ms-2 fw-semibold fs-5 text-light">Channel Name</div>
      <div class="col d-flex flex-grow-1 justify-content-end">Members</div>
    </div>
  </div>

  <div class="chat-body d-flex flex-column h-100">
    <chat-component />
  </div>

</div>

{{-- <div class="show-chat-container h-inherit">
    <div class="card border-0 h-inherit">
        <div class="card-header">
            <div class="row d-flex align-items-center">
                <div class="col-2 col-sm-1">
                    @if ($channel->avatar)
                    <img src="{{ asset('storage/' . $channel->avatar) }}" class="rounded-square" alt="avatar">
                    @else
                        <img src="{{ asset('storage/channel_avatar/default-image.jpg') }}" class="rounded-square" alt="default-avatar">
                    @endif
                </div>
                <div class="col-3 col-sm-5 fw-bold fs-5">
                    {{ $channel->name }}
                </div>
                <div class="col-5 col-sm-4">
                    <div class="input-group">
                        <input type="search" class="form-control" name="search" placeholder="Search">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <div class="col-2 col-sm-2 text-end">
                    <div class="modal fade" id="membersModal" aria-hidden="true" aria-labelledby="membersModalLabel" tabindex="-1">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="membersModalLabel">{{ $channel->name }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-start">
                                        @if (session()->has('add-user-success'))
                                            <div class="alert alert-success text-center"><i class="bi bi-check-circle-fill me-1"></i>{{ session('add-user-success') }}</div>
                                        @endif
                                        @if (session()->has('remove-user-success'))
                                        <div class="alert alert-danger text-center">{{ session('remove-user-success') }}</div>
                                        @endif
                                        <table class="table table-borderless table-hover">
                                            <thead>
                                                <tr><th>Members</th></tr>
                                            </thead>
                                            <tbody>
                                                @if ( Auth::user()->role_id == config('const.user_role.admin') )
                                                <tr class="align-middle">
                                                    <td colspan="2">
                                                        <button id="addPeopleButton" class="btn btn-sm btn-outline-primary border-0" data-bs-target="#addPeopleModal" data-bs-toggle="modal">
                                                            <i class="bi bi-person-plus-fill me-1"></i>Add people
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endif
                                                @foreach ( $channelMembers as $channelMember )
                                                    @if ($channelMember->channel_id == $channel->id)
                                                        <tr class="align-middle">
                                                            <td>{{ $channelMember->member->email }}</td>
                                                            @if (Auth::user()->role_id == config('const.user_role.admin'))
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <form action="{{ route('web.remove.member', ['user' => $channelMember->member->id, 'channel' => $channelMember->channel_id]) }}" method="post">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Are you sure you want to remove {{ $channelMember->member->email }}?')">
                                                                                <i class="bi bi-x-lg"></i>
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="addPeopleModal" aria-hidden="true" aria-labelledby="addPeopleModalLabel" tabindex="-1">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addPeopleModalLabel">Users</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-start">
                                        <table class="table table-borderless table-hover">
                                            <thead>
                                                <tr></tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $usersCount = $users->count();
                                            @endphp
                                            @foreach ( $users as $user )
                                                @php
                                                    $isMember = $user->memberChannels->contains('id', $channel->id);
                                                    if ($isMember) {
                                                        $usersCount--;
                                                    }
                                                @endphp
                                                @if (!$isMember)
                                                    <tr class="align-middle">
                                                        <td>{{ $user->email }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <form action="{{ route('web.add.member', ['channel' => $channel, 'user' => $user]) }}" method="post">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-outline-primary border-0" onclick="return confirm('Are you sure you want to add {{ $user->email }} to {{ $channel->name }}?')">
                                                                        <i class="bi bi-plus-lg" ></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            @if ($usersCount < 1)
                                                <tr>
                                                    <td class="text-center">Add more <a href="{{ route('users.create') }}">users</a></td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-sm btn-outline-secondary p-2 fw-bold border-0" data-bs-toggle="modal" href="#membersModal" role="button">
                        <i class="bi bi-people-fill me-2"></i>{{ $channelMembers->where('channel_id', $channel->id)->count() }}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <chat-component :channel="{{ $channel }}" :current-user="{{ Auth::user() }}"/>
        </div>
    </div>
</div> --}}

{{-- Javascript --}}
{{-- @if (session('openMembersModal'))
    <script>
        $(document).ready(function () {
            $('#membersModal').modal('show');
        });
    </script>
@endif --}}

{{-- <div class="container-fluid" id="container-channel-index">
  
  @if (session()->has('success'))
    <div class="alert alert-success text-center" role="alert">{{ session('success') }}</div>
  @endif
  <div class="row p-3 h-100">
    <div class="side-menu h-inherit col-sm-2 p-2">
      <div class="side-accordion accordion accordion-flush d-flex h-inherit" id="accordionPanelsStayOpenExample">
        <div class="channels-accordion accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
              Channels
            </button>
          </h2>
          <div id="panelsStayOpen-collapseOne" class="show-collapse-accordion accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
            <div class="accordion-body p-1" id="accordion-channel-list">
              <nav class="nav flex-column">
                @php
                  $isMemberOfAnyChannel = false;
                @endphp
                @foreach ( $channels as $channel )
                  @php
                    $isMember = $channel->members->contains('id', Auth::user()->id);
                    if ($isMember) {
                      $isMemberOfAnyChannel = true;
                    }
                  @endphp
                  @if ($isMember)
                    <a class="nav-link" href="{{ route('web.channels.show', $channel) }}">
                      <div class="container-sm-fluid">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            @if ($channel->avatar)
                              <img src="{{ asset('storage/' . $channel->avatar) }}" class="channel-avatar" alt="avatar">
                            @else
                              <img src="{{ asset('storage/channel_avatar/default-image.jpg') }}" class="channel-avatar" alt="default-avatar">
                            @endif
                          </div>
                          <div class="col">{{ $channel->name }}</div>
                        </div>
                      </div>
                    </a>
                  @endif
                @endforeach
                @if (!$isMemberOfAnyChannel)
                  <span class="text-center">No channels available.</span>
                @endif
              </nav>
            </div>
            <div class="accordion-body bg-light p-1">
              <nav class="nav flex-column">
                @if (Auth::user()->role_id == config('const.user_role.admin'))
                  <a class="nav-link" href="{{ route('web.channels.create') }}"><i class="bi bi-plus-square-fill me-2"></i>Add channels</a>
                @endif
              </nav>
            </div>
          </div>
        </div>
        <div class="direct-messages-accordion accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
              Direct Messages
            </button>
          </h2>
          <div id="panelsStayOpen-collapseTwo" class="show-collapse-accordion accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
            <div class="accordion-body p-1" id="accordion-direct-message-list">
              <nav class="nav flex-column">
                <a class="nav-link" href="#">Link</a>
              </nav>
            </div>
            <div class="accordion-body bg-light p-1">
              <nav class="nav flex-column">
                @if (Auth::user()->role_id == config('const.user_role.admin'))
                  <a class="nav-link" href="#"><i class="bi bi-plus-square-fill me-2"></i>Add coworkers</a>
                @endif
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="show-chat h-inherit col-sm-10 p-2">
      @yield('chat-content')
    </div>
  </div>

</div> --}}

@endsection