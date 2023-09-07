<?php

namespace App\Models;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChannelMember extends Model
{
    use HasFactory;

    /**
     * Specifying the table name
     * 
     * @var string
     */
    protected $table = 'channel_members';

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
        'channel_id',
        'member_id',
        'added_by'
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
     * Many to One with channels as channel
     */
    public function channel()
    {
        return $this->belongsTo('App\Models\Channel', 'channel_id', 'id');
    }

    /**
     * Many to One with users as member
     */
    public function member()
    {
        return $this->belongsTo('App\Models\User', 'member_id', 'id');
    }

    /**
     * Many to One with users as added by
     */
    public function addedBy()
    {
        return $this->belongsTo('App\Models\User', 'added_by', 'id');
    }

    // =================================
    // Methods
    // =================================

    /**
     * Returns the list of channel members
     */
    public static function list()
    {
        return self::with('channel', 'member', 'addedBy')->get();
    }
}
