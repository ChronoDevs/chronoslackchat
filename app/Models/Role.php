<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * Specifying the table name
     * 
     * @var string
     */
    protected $table = 'roles';

    /**
     * Specifying the primary key
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Specifying the columns that allow assignment in create method
     * 
     * @var array
     */
    protected $fillable = [
        'code',
        'name'
    ];
    
    /**
     * Specifying the columns that are dates
     * 
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Attributes that are not mass assignable
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    // =================================
    // Methods
    // =================================
    
    /**
     * Returns the list of roles
     */
    public static function list()
    {
        return self::get();
    }
}
