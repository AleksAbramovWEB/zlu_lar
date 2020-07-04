<?php

namespace App\Models\Connexion\News;

use Illuminate\Database\Eloquent\Model;

class NewsVipGiven extends Model
{
    protected $table = 'news_vip_given';

    protected $fillable = [
       'user_id',
       'vip_given_id',
       'days',
       'views'
    ];
}
