<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profile';

    protected $fillable = [
        'address', 'phone'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
