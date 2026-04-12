<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $fillable = ['name', 'category_id', 'parent_id'];
    public function files(){
        return $this->hasMany(File::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
