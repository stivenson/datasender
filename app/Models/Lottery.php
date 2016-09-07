<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Assist
 */
class lottery extends Model
{
    use SoftDeletes;

    
    protected $table = 'lotteries';

    public $timestamps = true;

    protected $fillable = [
        'name'
    ];

    protected $guarded = [];

}