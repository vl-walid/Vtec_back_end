<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogPost;
class ListItem extends Model
{    protected $fillable = ['blog_post_id', 'list_content'];

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }
    use HasFactory;
}
