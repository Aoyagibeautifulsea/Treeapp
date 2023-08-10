<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class source_story extends Model
{
    use HasFactory;
    
    public function sourcestory()   
{
    return $this->belongsTo(Post::class);  
}

}
