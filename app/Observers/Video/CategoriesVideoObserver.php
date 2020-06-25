<?php

namespace App\Observers\Video;

use App\Models\Video\CategoriesVideo;

class CategoriesVideoObserver
{

    public function creating(CategoriesVideo $categoriesVideo)
    {
        $this->stringChange($categoriesVideo);
    }

    /**
     * Handle the categories video "updated" event.
     *
     * @param  \App\Models\Video\CategoriesVideo  $categoriesVideo
     * @return void
     */
    public function updating(CategoriesVideo $categoriesVideo)
    {
        $this->stringChange($categoriesVideo);
    }


    private function stringChange(CategoriesVideo $categoriesVideo){
        $categoriesVideo->slug = \Str::slug($categoriesVideo->slug, '_');
        $categoriesVideo->title_ru = \Str::ucfirst(\Str::lower($categoriesVideo->title_ru));
        $categoriesVideo->title_en = \Str::ucfirst(\Str::lower($categoriesVideo->title_en));
    }



}
