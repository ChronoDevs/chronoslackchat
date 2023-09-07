<?php

namespace App\Http\Controllers\WEB;

use App\Models\User;
use App\Models\Channel;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Models\ChannelMember;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChannelRequest;
use App\Http\Requests\MessageRequest;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $channels = Channel::list();

        return view('pages.channels.index', compact('channels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.channels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChannelRequest $request)
    {
        $params = $request->validated();
        Channel::register($params);

        return redirect()->route('web.channels.index')->with('success', 'Channel Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Channel $channel)
    {
        $channels = Channel::list();
        $channelMembers = ChannelMember::list();
        $users = User::list();

        return view('pages.channels.index', compact(
            'channel', 
            'channels', 
            'channelMembers', 
            'users'
        ));
    }

    /**
     * Add user to the channel
     */
    public function addMember(Request $request, User $user, Channel $channel)
    {
        $channel->addMember($user, $channel);
        $request->session()->flash('add-user-success', $user->email . ' added successfully!');

        return redirect()->route('web.channels.show', $channel)->with('openMembersModal', true);
    }

    /**
     * Remove user to the channel
     */
    public function removeMember(Request $request, User $user, Channel $channel)
    {
        $channel->removeMember($user, $channel);
        $request->session()->flash('remove-user-success', $user->email . ' removed from the channel.');

        return redirect()->route('web.channels.show', $channel)->with('openMembersModal', true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
