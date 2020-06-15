<?php

namespace App\Http\Controllers\Admin\Video;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Video\CreateVideoRequest;
use App\Http\Requests\Admin\Video\EditVideoRequest;
use App\Models\Video\Video;
use App\Models\Video\VideoCategoryUnite;
use App\Repositories\Video\CategoriesRepository;
use App\Repositories\Video\VideoRepository;
use App\Traits\S3FileWork;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    use S3FileWork;

    /**
     * Display a listing of the resource.
     * @param VideoRepository      $videoRepository
     * @param CategoriesRepository $categoriesRepository
     * @return void
     */
    public function index(VideoRepository $videoRepository)
    {
        $films = $videoRepository->getVideoForAdminList();

        return view('admin.video.index_video', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     * @param CategoriesRepository $categoriesRepository
     * @return \Illuminate\Http\Response
     */
    public function create(CategoriesRepository $categoriesRepository)
    {
        $categories = $categoriesRepository->getAllCategories();
        return view('admin.video.create_video', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateVideoRequest $request
     * @param Video              $video
     * @return void
     */
    public function store(CreateVideoRequest $request, Video $video)
    {
        $array = $request->input();
        $array['path_video'] = $this->S3putFile($request, 'video', 'video/films');
        $array['path_img'] = $this->S3putFile($request, 'img', 'video/img');
        $film = $video::create($array);
        $this->setCategoryVideo($array, $film->id);
        return redirect()->route("admin.video.show", $film->id);
    }

    /**
     * Display the specified resource.
     * @param VideoRepository         $videoRepository
     * @param                         $id
     * @return void
     */
    public function show(VideoRepository $videoRepository, $id)
    {
        $video = $videoRepository->getVideoByIdWithDeleted($id);
        return view('admin.video.show_video', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param VideoRepository      $videoRepository
     * @param CategoriesRepository $categoriesRepository
     * @param                      $id
     * @return void
     */
    public function edit(VideoRepository $videoRepository, CategoriesRepository $categoriesRepository, $id)
    {
        $video = $videoRepository->getVideoByIdWithDeleted($id);
        $categories = $categoriesRepository->getAllCategories();
        return view('admin.video.edit_video', compact('video', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditVideoRequest $request
     * @param Video            $video
     * @param                  $id
     * @return void
     */
    public function update(EditVideoRequest $request, Video $video, $id)
    {
        $inputs = $request->input();
        $video::find($id)->update($inputs);
        $this->setCategoryVideo($inputs, $id);
        return back()->with('success', true);
    }

    private function setCategoryVideo(array $inputs, $id){
        $add = [];
        $remove = [];
        $united = new VideoCategoryUnite();

        foreach ($inputs as $key => $val){
            if (!preg_match("~category_([0-9]+)~", $key, $matches, PREG_UNMATCHED_AS_NULL )) continue;
            if($val == 1) $add[] = ['video_id' => $id, 'category_id' => $matches[1]];
            elseif($val == 0) $remove[] = [['video_id', $id], ['category_id' , $matches[1]]];
        }
        $united->insertOrIgnore($add);
        foreach ($remove as $where)
             $united->where($where)->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param VideoRepository         $videoRepository
     * @param                         $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoRepository $videoRepository, $id)
    {
        $video = $videoRepository->getVideoByIdWithDeleted($id);
        if (empty($video)) abort(404);

        if ($video->trashed()) $video->restore();
        else $video->delete();

        return back()->with('success', true);
    }
}
