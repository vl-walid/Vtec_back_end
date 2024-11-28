<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogOverview;
use App\Models\SmallTitle;
use App\Models\ListItem;

class BlogPost extends Model
{
    protected $fillable = [
        'blog_overview_id',
        'main_paragraph',
        'summary_paragraph',
        'additional_image_1',
        'additional_image_2',
    ];

    public function overview()
    {
        return $this->belongsTo(BlogOverview::class, 'blog_overview_id');
    }
    public function smallTitles()
    {
        return $this->hasMany(SmallTitle::class);
    }

    public function listItems()
    {
        return $this->hasMany(ListItem::class);
    }

use HasFactory ;

}
