<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'released_date', 'age_limit', 'ai_generate_check','explanation'];
    
    // <--toppage関連-->
    public function gettoppage(int $limit_count = 20)
{
    return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
}
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
    public function tags()
{
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
}
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'post_id', 'user_id')->withTimestamps();
    }
}
