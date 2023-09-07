<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Channel;
use App\Models\ChannelAdmin;
use App\Models\ChannelMember;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DefaultChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $defaultUser = $users->first();
        $adminMembers = $users->where('role_id', config('const.user_role.admin'));

        foreach ( $users as $user ) {
            $channel = Channel::firstOrCreate([
                'name' => 'random',
                'creator_id' => $defaultUser->id
            ]);

            ChannelMember::firstOrCreate([
                'channel_id' => $channel->id,
                'member_id' => $user->id,
                'added_by' => $defaultUser->id
            ]);
                
            foreach ( $adminMembers as $adminMember ) {
                ChannelAdmin::firstOrCreate([
                    'channel_id' => $channel->id,
                    'member_id' => $adminMember->id
                ]);
            }
        }
    }
}
