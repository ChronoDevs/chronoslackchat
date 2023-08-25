@extends('layout.app')
@extends('layout.navbar')

@section('content')
<div class="container-fluid" id="container-channel-index">
  
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

</div>
@endsection