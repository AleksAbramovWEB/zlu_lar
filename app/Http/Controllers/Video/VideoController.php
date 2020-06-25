<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use App\Models\Video\Video;
use App\Models\Video\VideoLikes;
use App\Repositories\Video\CategoriesRepository;
use App\Repositories\Video\VideoLikesRepository;
use App\Repositories\Video\VideoRepository;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * основная страница видоо
     *
     * @param CategoriesRepository $categoriesRepository
     * @param VideoRepository      $videoRepository
     * @param Request              $request
     * @return \Illuminate\View\View
     */
    public function index(
        CategoriesRepository $categoriesRepository,
        VideoRepository $videoRepository,
        Request $request
    ){
        $categories = $categoriesRepository->getAllCategoriesForIndexVideo();
        $categories_list = $categoriesRepository->getAllCategoriesVideoExistsIsPublished();
        $videos = $videoRepository->getVideoForIndex($request->sort);
        $videos->appends($request->toArray())->links();
        return view('video.index_video', compact('categories', 'categories_list', 'videos', 'request'));
    }


    public function category(CategoriesRepository $categoriesRepository, $slug,
                             Request $request){
        $category = $categoriesRepository->getCategoryBySlugWithVideo($slug, $request->sort);
        if(empty($category)) abort(404);
        return view('video.category_video', compact('category', 'request'));
    }

    public function library(
        VideoRepository $videoRepository, $id,
        VideoLikesRepository $likesRepository
    ){
        $video = $videoRepository->getVideoById($id);
        if(empty($video)) abort(404);
        $countLikes = $likesRepository->getCountLikeForVideo($id);
        $myLike = $likesRepository->getMyLikeCount($id);
        return view('video.show_video', compact('video', 'countLikes', 'myLike'));
    }

    public function views(Video $videos, $id){
        $video = $videos->find($id);
        if (empty($video)) abort(404);
        $video->timestamps = false;
        ++$video->views;
        $video->save();
    }

    public function my_video_likes(VideoLikesRepository $likesRepository){
        $likes = $likesRepository->getLikesWithVideo(\Auth::id());
        return view('video.my_likes_video', compact('likes'));
    }

    public function like(VideoLikes $videoLikes, VideoLikesRepository $likesRepository, $id)
    {
        $like = $likesRepository->getMyLike($id);
        if (empty($like))
            $videoLikes::create([
                'video_id' => $id,
                'user_id' => \Auth::id(),
            ]);
        else $like->delete();

        $countLikes['count'] = $likesRepository->getCountLikeForVideo($id);

        return response()->json($countLikes);

    }

}
