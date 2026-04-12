<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected  $fillable = [
        'name',
        'file_path',
        'file_type',
        'folder_id',
    ];

    public function folder(){
        return $this->belongTo(Folder::class);
    }

    public function getIcon(){
        return match(strtolower($this->file_type)){
            'pdf' => 'https://cdn-icons-png.flaticon.com/512/337/337946.png',
            'doc', 'docx' => 'https://cdn-icons-png.flaticon.com/512/337/337932.png',
            'xls', 'xlsx' => 'https://cdn-icons-png.flaticon.com/512/337/337958.png',
            default => 'https://cdn-icons-png.flaticon.com/512/337/337940.png',
        };
    }
}

