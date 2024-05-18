<?php

namespace App;
use App\User;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $table = 'artists';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'u_id', 'description', 'location', 'speciality','price', 'image',
    ];

    /**
     * Define the inverse of the one-to-one relationship with User model.
     */
    public function user(){
        return $this->belongsTo(User::class,'u_id');
    }

    public function appointments() {
        return $this->hasMany(Appointment::class);
    }
}
