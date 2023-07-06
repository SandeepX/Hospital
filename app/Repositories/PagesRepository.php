<?php

namespace App\Repositories;

use App\Models\Page;

class PagesRepository
{

    public function getAllPages($select=['*'])
    {
        return Page::select($select)->where('is_active',1)->latest()->get();
    }

    public function findPageById($id)
    {
        return Page::where('id',$id)->first();
    }

    public function update($pageDetail ,$validatedData)
    {
        return $pageDetail->update($validatedData);
    }

    public function findPageDetailBYPageSlug($slug)
    {
        return Page::where('slug',$slug)->first();
    }

    public function findActivePageDetailBySlug($slug,$select=['*'])
    {
        return Page::select($select)->where('slug',$slug)->where('is_active',1)->get();
    }

}
