<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $table = 'recommendation';

    protected $fillable = [
    	'ma_id','mean_rating',
    ];
}
