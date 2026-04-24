<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['full_name', 'photo', 'description', 'profile_category', 'vision', 'mission'];
}
