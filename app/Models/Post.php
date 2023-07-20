<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    // <--toppage関連-->
    public function gettoppage(int $limit_count = 20)
{
    return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
}
//  <--リレーション-->
    public function creator()
{
    return $this->belongsTo(Creator::class);
}
    public function comment()
{
    return $this->belongsTo(Comment::class);
}
    public function image()
{
    return $this->belongsTo(Image::class);
}
    public function link()
{
    return $this->belongsTo(Link::class);
}

}
