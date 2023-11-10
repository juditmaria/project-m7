<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Post extends Model
{
    /**
     *  Model relacionat entre el model Post y File (1:1)
     */
    public function file()
    {
    return $this->belongsTo(File::class);
    }

    /**
     *  Model relacionat entre el model Post y User (1:N)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function author()
    {
        return $this->belongsTo(User::class);
    }

}