<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogPost;
class SmallTitle extends Model
{   protected $fillable = ['blog_post_id', 'title', 'paragraph'];

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }
    use HasFactory;
}
