<?php

namespace App\Http\Controllers\WEB;

use App\Models\Channel;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Fetch the messages of the specific channel
     */
    public function fetchMessages(Request $request, Channel $channel)
    {
        // Group messages to show by dates
        $messages = Message::where('channel_id', $channel->id)->get();
        

        // $messages = Message::where('channel_id', $channel->id)->limit(50)->get();

        return $messages->load('user');
    }

    /**
     * Send a message to the specific channel
     */
    public function sendMessage(Request $request, Channel $channel)
    {
        $user = Auth::user();
        
        $message = $user->messages()->create([
            'channel_id' => $channel->id,
            'member_id' => $user->id,
            'message' => $request->input('message')
        ]);

        broadcast(new MessageSent($user, $message))->toOthers();

        return $message->load('user');
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
