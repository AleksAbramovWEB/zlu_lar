<?php

namespace App\Http\Controllers\Admin\Connexion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Connexion\Gifts\GiftsAddRequest;
use App\Http\Requests\Admin\Connexion\Gifts\GiftsUpdateRequest;
use App\Models\Connexion\Gifts\Gifts;
use App\Repositories\Connexion\Gifts\GiftsRepository;
use Illuminate\Http\Request;

class GiftsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param GiftsRepository $giftsRepository
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GiftsRepository $giftsRepository)
    {
        $gifts = $giftsRepository->getAllGiftsWithDeletes();
        return view("admin.connexion.gifts.index", compact('gifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.connexion.gifts.create");
    }

    /**
     * Store a newly created resource in storage.
     * @param GiftsAddRequest $request
     * @param Gifts           $gifts
     * @return void
     */
    public function store(GiftsAddRequest $request, Gifts $gifts)
    {
        $path = $request->file('picture')->store('png/gifts', 'img');
        $gifts::create([
            'path' => "img/$path",
            'price' => $request->price,
            'title_ru' => $request->title_ru,
            'title_en' => $request->title_en,
        ]);
        return redirect()->route("admin.connexion.gifts.index");
    }


    /**
     * Show the form for editing the specified resource.
     * @param GiftsRepository $giftsRepository
     * @param                 $id
     * @return \Illuminate\Http\Response
     */
    public function edit(GiftsRepository $giftsRepository, $id)
    {
        $gift = $giftsRepository->getByIdGiftsWithDeletes($id);
        if (empty($gift)) abort(404);
        return view("admin.connexion.gifts.edit", compact('gift'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GiftsUpdateRequest                $request
     * @param GiftsRepository                   $giftsRepository
     * @param                                   $id
     *
     * @return void
     */
    public function update(GiftsUpdateRequest $request, GiftsRepository $giftsRepository , $id)
    {
        $gift = $giftsRepository->getByIdGiftsWithDeletes($id);
        if (empty($gift)) abort(404);
        $gift->update($request->input());
        return back()->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     * @param GiftsRepository                   $giftsRepository
     * @param                                   $id
     * @return void
     */
    public function destroy(GiftsRepository $giftsRepository, $id)
    {
         $gift = $giftsRepository->getByIdGiftsWithDeletes($id);
         if (empty($gift)) abort(404);

        if ($gift->trashed()) $gift->restore();
        else $gift->delete();

        return back()->with('success', true);
    }
}
