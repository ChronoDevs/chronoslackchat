@extends('layouts.app')

@section('content')
<div class="container-fluid h-inherit">
    <div class="row flex-nowrap h-inherit">
        <div class="col-auto p-2 d-flex flex-column">

            <div class="dashboard-header">
                <div class="row m-auto align-items-center">
                    <div class="col-auto">
                        <a href="{{ route('web.channels.index') }}">
                            <img src="{{ asset('storage/img/logo.svg') }}" alt="ChronoStep Logo" width="50" height="50" class="img-fluid">
                        </a>
                    </div>
                    <div class="col fw-semibold text-color">
                        CHRONOSLACK
                    </div>
                    <div class="col text-end">
                        <button type="button" class="new-chat-button btn btn-secondary btn-sm rounded-circle"><i class="bi bi-pencil"></i></button>
                    </div>
                </div>
            </div>

            <div class="dashboard-search my-3">
                <div class="row m-auto align-items-center">
                    <div class="col">
                        <form role="search">
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="search" class="form-control border-start-0" name="search" placeholder="Search">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="dashboard-channels d-flex flex-column flex-grow-1" id="dashboard-channels">
                <div class="channel-toggle-header fw-semibold text-secondary p-2" role="button" id="toggle-channels">
                    <div class="row">
                        <div class="col">Channels</div>
                        <div class="col text-end"><i class="bi bi-caret-down-fill" id="channel-down-icon-toggle"></i></div>
                    </div>
                </div>
                <div class="channel-body p-2 d-flex flex-grow-1" id="channel-list">
                    <div class="overflow-channel" id="overflow-channel">
                        @foreach ( $channels as $channel )
                            <a href="{{ route('web.channels.show', $channel) }}" class="text-decoration-none text-dark">
                                <div class="channel-item mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="row m-0 flex-fill align-items-center">
                                            <div class="col-auto p-0">
                                                @if ($channel->avatar)
                                                    <img src="{{ asset('storage/' . $channel->avatar) }}" width="50" height="50"  class="img-fluid rounded-circle" alt="channel-avatar">
                                                @else
                                                    <img src="{{ asset('storage/img/default-profile-pic.jpg') }}" width="50" height="50"  class="img-fluid rounded-circle border border-dark" alt="default-avatar">
                                                @endif
                                            </div>
                                            <div class="col ps-1">
                                                <div class="row ms-2 flex-column">
                                                    <div class="col p-0 custom-truncate fw-semibold">{{ $channel->name }}</div>
                                                    <div class="col p-0 custom-truncate">{{-- Recent message here --}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @if ( Auth::user()->role_id == config('const.user_role.admin'))
                    <a href="{{ route('web.channels.create') }}" class="text-decoration-none text-dark fw-semibold">
                        <div class="channel-footer py-3" id="add-channels">
                            <div class="row">
                                <div class="col text-center"><i class="bi bi-plus-lg"></i> Add channels</div>
                            </div>
                        </div>
                    </a>
                @endif
            </div>

            <div class="dashboard-direct-messages d-flex flex-column flex-grow-1" id="dashboard-direct-messages">
                <div class="direct-message-toggle-header fw-semibold text-secondary p-2" role="button" id="toggle-direct-messages">
                    <div class="row">
                        <div class="col">Direct Messages</div>
                        <div class="col text-end"><i class="bi bi-caret-down-fill" id="direct-down-icon-toggle"></i></div>
                    </div>
                </div>
                <div class="direct-message-body p-2 d-flex flex-grow-1" id="direct-message-list">
                    <div class="overflow-direct-message" id="overflow-direct-message">
                        <div class="direct-message-item my-2">
                            <div class="d-flex align-items-center">
                                <div class="row m-0 flex-fill align-items-center">
                                    <div class="col-auto p-0">
                                        <img src="{{ asset('storage/img/default-profile-pic.jpg') }}" width="50" height="50"  class="img-fluid rounded-circle border border-dark" alt="default-avatar">
                                    </div>
                                    <div class="col ps-1">
                                        <div class="row ms-2 flex-column">
                                            <div class="col p-0 custom-truncate fw-semibold">Julcarl Selma</div>
                                            <div class="col p-0 custom-truncate">Test: This text is quite long, and will be truncated once displayed. </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ( Auth::user()->role_id == config('const.user_role.admin'))
                    <a href="#" class="text-decoration-none text-dark fw-semibold">
                        <div class="direct-message-footer py-3" id="add-coworkers">
                            <div class="row">
                                <div class="col text-center"><i class="bi bi-plus-lg"></i> Add coworkers</div>
                            </div>
                        </div>
                    </a>
                @endif
            </div> 
            
        </div>
        <div class="col p-0 pt-2">
            @yield('navbar')
            @yield('page')
        </div>
    </div>
</div>
@endsection