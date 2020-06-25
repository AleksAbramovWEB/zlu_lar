<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Video\VideoRepository;
use Illuminate\Http\Request;

class HomeController extends AdminController
{
    public function index(VideoRepository $repository){
        $stats_video = $repository->totalStats();
        return view("admin.home", compact('stats_video'));
    }
}
