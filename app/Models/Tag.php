<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];
    
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_id');
    }
   public function favoritetag()
    {
        return $this->belongsToMany(Post::class, 'tag_user', 'tag_id', 'user_id')->withTimestamps();
    }
}
