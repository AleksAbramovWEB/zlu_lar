<?php

namespace App\Http\Controllers\Admin\Video;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Video\CreateCategoryVideoRequest;
use App\Http\Requests\Admin\Video\EditCategoryVideoRequest;
use App\Models\Video\CategoriesVideo;
use App\Repositories\Video\CategoriesRepository;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;

class CategoriesVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param CategoriesRepository $categoriesRepository
     * @param Request              $request
     * @return void
     */
    public function index(CategoriesRepository $categoriesRepository, Request $request)
    {
        $categories = $categoriesRepository->getCategoriesForAdminListWithDeleted($request);
        return view("admin.video.categories.index_categories", compact('categories' , 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.video.categories.create_categories");
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateCategoryVideoRequest $request
     * @param CategoriesVideo            $categoriesVideo
     * @return void
     */
    public function store(CreateCategoryVideoRequest $request, CategoriesVideo $categoriesVideo)
    {
        $categoriesVideo::create($request->input());
        return redirect()->route('admin.video.categories.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param CategoriesRepository $categoriesRepository
     * @param                      $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(CategoriesRepository $categoriesRepository, $id)
    {
        $category = $categoriesRepository->getCategoryByIdWithDeleted($id);
        return view("admin.video.categories.edit_categories", compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditCategoryVideoRequest $request
     * @param CategoriesVideo          $categoriesVideo
     * @param                          $id
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update(EditCategoryVideoRequest $request, CategoriesVideo $categoriesVideo, $id)
    {
        $categoriesVideo::find($id)->update($request->input());
        return back()->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CategoriesRepository $categoriesRepository
     * @param                      $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriesRepository $categoriesRepository, $id)
    {
        $category = $categoriesRepository->getCategoryByIdWithDeleted($id);
        if (empty($category)) abort(404);

        if ($category->trashed()) $category->restore();
        else $category->delete();

        return back()->with('success', true);
    }
}
