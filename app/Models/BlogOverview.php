<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogPost;

class BlogOverview extends Model
{
    protected $fillable = ['main_title', 'main_image', 'date_added'];

    public function blogPost()
    {
        return $this->hasOne(BlogPost::class);
    }
    use HasFactory;
}

