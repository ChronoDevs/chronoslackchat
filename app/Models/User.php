<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Person;
use App\Models\Channel;
use App\Models\ChannelMember;
use App\Models\ChannelAdmin;
use App\Models\Message;
use DB;

use App\Notifications\OnlineUserSentNotification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    
    /**
     * Specifying the table name
     * 
     * @var string
     */
    protected $table = 'users';

    /**
     * Specifying the primary key
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'person_id',
        'role_id',
        'username',
        'email',
        'password',
        'phone',
        'isOnline',
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    // =================================
    // Relationships
    // =================================

    public function person()
    {
        return $this->hasOne('App\Models\Person', 'id', 'person_id');
    }

    public function role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'role_id');
    }

    /**
     * One to Many with channels as creator
     */
    public function createdChannels()
    {
        return $this->hasMany('App\Models\Channel', 'creator_id', 'id');
    }

    /**
     * Many to Many with channels as member
     */
    public function memberChannels()
    {
        return $this->belongsToMany('App\Models\Channel', 'channel_members', 'member_id', 'channel_id')
            ->withPivot('added_by');
    }

    /**
     * Many to Many with channels as admin
     */
    public function adminChannels()
    {
        return $this->belongsToMany('App\Models\Channel', 'channel_admins', 'member_id', 'channel_id');
    }

    /**
     * One to Many with channel members as added by
     */
    public function addedChannels()
    {
        return $this->hasMany('App\Models\ChannelMember', 'added_by', 'id');
    }

    /**
     * One to Many with messages
     */
    public function messages()
    {
        return $this->hasMany('App\Models\Message', 'member_id', 'id');
    }
    

    // =================================
    // Methods
    // =================================
    /**
     * 
     */
    public function sendOnlineUserNotification(array $data) : void
    {
        $this->notify(new OnlineUserSentNotification($data));
    }

    /**
     * Returns the list of users with relations
     */
    public static function list()
    {
        return self::with('person', 'role', 'memberChannels')->paginate(5);
    }

    /**
     * Register a new user
     */
    public static function register(array $params)
    {
        DB::beginTransaction();
        try {
            $person = Person::create([
                'firstname' => $params['firstname'],
                'middlename' => $params['middlename'],
                'lastname' => $params['lastname'],
                'suffix' => $params['suffix'],
                'birthdate' => $params['birthdate']
            ]);
            
            DB::commit();
            return self::create([
                'person_id' => $person->id,
                'role_id' => $params['role'],
                'username' => $params['username'],
                'email' => $params['email'],
                'password' => $params['password'],
                'phone' => $params['phone']
            ]);
        } catch (\Exception $e) {
            \Log::error(get_class(). ' register(): '. $e);
            $message = $e->getMessage();

            DB::rollback();
            return $message;
        }
    }

    /**
     * Update the user record
     */
    public static function updater($user, array $params)
    {
        DB::beginTransaction();
        try {
            // Retrieve person relation
            $person = $user->person;

            $person->update([
                'firstname' => $params['firstname'],
                'middlename' => $params['middlename'],
                'lastname' => $params['lastname'],
                'suffix' => $params['suffix'],
                'birthdate' => $params['birthdate'],
            ]);
           
            $user->update([
                'person_id' => $person->id,
                'role_id' => $params['role'],
                'username' => $params['username'],
                'email' => $params['email'],
                'phone' => $params['phone'],
                'password' => Hash::make($params['password'])
            ]);

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            \Log::error(get_class(). ' updater(): '. $e);
            $message = $e->getMessage();

            DB::rollback();
            return $message;
        }
    }

    /**
     * Delete the user record
     */
    public function deleter()
    {
        DB::beginTransaction();
        try {
            DB::commit();
            $this->delete();
        } catch (\Exception $e) {
            \Log::error(get_class(). ' deleter(): '. $e);
            $message = $e->getMessage();

            DB::rollback();
            return $message;
        }
    }
}
