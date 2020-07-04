<?php

namespace App\Models\Connexion\News;

use Illuminate\Database\Eloquent\Model;

class NewsProfileViews extends Model
{
    protected $table = 'news_profile_views';
    protected $fillable = ['user_id', 'watcher_id', 'views'];
}
