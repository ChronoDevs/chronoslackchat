<?php

namespace App\Models;

use App\Models\User;
use App\Models\ChannelMember;
use App\Models\ChannelAdmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Channel extends Model
{
    use HasFactory;

    /**
     * Specifying the table name
     * 
     * @var string
     */
    protected $table = 'channels';

    /**
     * Specifying the primary key
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'avatar',
        'creator_id'
    ];

    /**
     * Specifying the columns that are dates
     * 
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Attributes that are not mass assignable
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // =================================
    // Relationships
    // =================================

    /**
     * Many to One with users as creator
     */
    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'creator_id', 'id');
    }

    /**
     * Many to Many with users as member
     */
    public function members()
    {
        return $this->belongsToMany('App\Models\User', 'channel_members', 'channel_id', 'member_id')
            ->withPivot('added_by');
    }

    /**
     * Many to Many with users as admin
     */
    public function admins()
    {
        return $this->belongsToMany('App\Models\User', 'channel_admins', 'channel_id', 'member_id');
    }

    /**
     * One to Many with channel members as channel members
     */
    public function channelMembers()
    {
        $this->hasMany('App\Models\ChannelMember', 'channel_id', 'id');
    }

    /**
     * One to Many with channel admins as channel admins
     */
    public function channelAdmins()
    {
        $this->hasMany('App\Models\ChannelAdmin', 'channel_id', 'id');
    }

    /**
     * One to Many
     */
    public function messages()
    {
        $this->hasMany('App\Models\Message', 'channel_id', 'id');
    }


    // =================================
    // Methods
    // =================================

    /**
     * Returns the list of channels
     */
    public static function list()
    {
        return self::with('members', 'admins')->get();
    }

    /**
     * Register a new channel
     */
    public static function register(array $params)
    {
        DB::beginTransaction();
        try {
            $channel = self::create([
                'name' => $params['name'],
                'creator_id' => Auth::user()->id
            ]);

            if (isset($params['avatar'])) {
                $avatar = $params['avatar'];
                $filePath = $avatar->store('channel_avatar', 'public');
                $channel->update(['avatar' => $filePath]);
            }

            ChannelMember::create([
                'channel_id' => $channel->id,
                'member_id' => Auth::user()->id,
                'added_by' => Auth::user()->id
            ]);

            ChannelAdmin::create([
                'channel_id' => $channel->id,
                'member_id' => Auth::user()->id
            ]);

            DB::commit();
            return $channel;
        } catch (\Exception $e) {
            \Log::error(get_class(). ' register(): '. $e);
            $message = $e->getMessage();

            DB::rollback();
            return $message;
        }
    }

    /**
     * Add user in the channel
     */
    public function addMember($user, $channel)
    {
        DB::beginTransaction();
        try {
            $addMember = $channel->members()->attach($user, ['added_by' => Auth::user()->id]);

            DB::commit();
            return $addMember;
        } catch (\Exception $e) {
            \Log::error(get_class(). ' addMember(): '. $e);
            $message = $e->getMessage();

            DB::rollback();
            return $message;
        }
    }

    /**
     * Remove user in the channel
     */
    public function removeMember($user, $channel)
    {
        DB::beginTransaction();
        try {
            $removeMember = $channel->members()->detach($user);

            DB::commit();
            return $removeMember;
        } catch (\Exception $e) {
            \Log::error(get_class(). ' addMember(): '. $e);
            $message = $e->getMessage();

            DB::rollback();
            return $message;
        }
    }
}
