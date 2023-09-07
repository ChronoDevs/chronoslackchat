<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * Specifying the table name
     * 
     * @var string
     */
    protected $table = 'messages';

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
        'direct_id',
        'group_direct_id',
        'member_id',
        'message',
        'isNotice',
        'isPinned'
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
     * One to Many
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'member_id', 'id');
    }

    // =================================
    // Methods
    // =================================
}
