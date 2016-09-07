<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Assist
 */
class Result extends Model
{
    use SoftDeletes;

    protected $table = 'lotteries';

    public $timestamps = true;

    protected $fillable = ['data','number','lottery_id'];

    protected $guarded = [];
    
    public function lottery()
    {
      return $this->belongsTo('Models\Lottery','lottery_id');
    }

}