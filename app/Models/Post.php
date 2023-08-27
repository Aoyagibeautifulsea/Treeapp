<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'released_date', 'age_limit', 'ai_generate_check','explanation'];
    
//  <--リレーション-->
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function creators()
    {
        return $this->hasMany(Creator::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function links()
    {
        return $this->hasMany(Link::class);
    }
   public function sourcestories()
    {
        return $this->belongsToMany(Post::class, 'source_stories', 'post_id', 'senior_post_id');
    }
    public function inspiredbystories()
    {
        return $this->belongsToMany(Post::class, 'inspired_by_stories', 'post_id', 'junior_post_id');
    }
    public function tags()
    {
            return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'post_id', 'user_id')->withTimestamps();
    }
    public function wishList()
    {
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id')->withTimestamps();
    }
}
