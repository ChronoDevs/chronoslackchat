<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\ChannelAdmin;
use App\Models\ChannelMember;
use Illuminate\Console\Command;

class UserToRandomChannel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'channel:user-to-random-channel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To add user in random channel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        $defaultUser = $users->first();

        $this->info('Starting adding user to random channel');
        $progress = $this->output->createProgressBar(count($users));
        foreach ( $users as $user ) {
            $randomChannelId = config('const.default_channel.random');
            $channelMemberExists = ChannelMember::where('channel_id', $randomChannelId)
                ->where('member_id', $user->id)
                ->exists();

            if (!$channelMemberExists) {
                ChannelMember::firstOrCreate([
                    'channel_id' => $randomChannelId,
                    'member_id' => $user->id,
                    'added_by' => $defaultUser->id
                ]);

                ChannelAdmin::firstOrCreate([
                    'channel_id' => $randomChannelId,
                    'member_id' => $defaultUser->id
                ]);
            }
            $progress->advance();
        }
        $progress->finish();

        return 0;
    }
}
