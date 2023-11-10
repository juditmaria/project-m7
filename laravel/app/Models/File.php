<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';

    protected $fillable = [
        'filepath',
        'filesize'
    ];

    /**
     *  Model relacionat entre el model Post y File (1:1)
     */
    public function post()
    {
        return $this->hasOne(Post::class);
    }
}
