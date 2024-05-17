<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'speciality', 'image', // Add other fields here
    ];

    /**
     * Define the inverse of the one-to-one relationship with User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
