<?php

namespace App\Models;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelAdmin extends Model
{
    use HasFactory;

    /**
     * Specifying the table name
     * 
     * @var string
     */
    protected $table = 'channel_admins';

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
        'member_id'
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
     * Get the channel associated with channel admin
     */
    public function channel()
    {
        return $this->belongsTo('App\Models\Channel', 'channel_id', 'id');
    }

    /**
     * Get the member associated with channel admin
     */
    public function member()
    {
        return $this->belongsTo('App\Models\User', 'member_id', 'id');
    }

    // =================================
    // Methods
    // =================================
}
