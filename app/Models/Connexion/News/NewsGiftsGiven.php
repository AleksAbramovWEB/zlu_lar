<?php

namespace App\Models\Connexion\News;

use Illuminate\Database\Eloquent\Model;

class NewsGiftsGiven extends Model
{
    protected $table = 'news_gifts_given';

    protected $fillable = ['user_id', 'gifts_given_id', 'views'];

    public $timestamps = false;
}
