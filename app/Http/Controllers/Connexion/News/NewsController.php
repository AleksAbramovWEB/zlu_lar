<?php

namespace App\Http\Controllers\Connexion\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        $news = \News::getNews();
        return view('connexion.news.index_news', compact('news'));
    }
}
