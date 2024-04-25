<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Makeup extends Model
{
    protected $table = 'makeups';
    protected $fillable = [
        'category','makeup_name','description','type','image','price',
    ];

}
