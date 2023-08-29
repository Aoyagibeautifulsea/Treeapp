<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    
    protected $fillable = ['external_link', 'external_link_explanation'];
    
    public function post()   
    {
        return $this->belongsTo(Post::class);  
    }
}
