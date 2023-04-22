<?php

namespace App\Repositories;

use App\Models\StaticPageDetail;
use App\Traits\ImageService;

class StaticPageDetailRepository
{
    use ImageService;

    public function getAllStaticPageDetail($select=['*'],$with=[])
    {
        return StaticPageDetail::select($select)->with($with)->latest()->paginate(StaticPageDetail::RECORDS_PER_PAGE);
    }

    public function findStaticPageDetailById($id, $select=['*'])
    {
        return StaticPageDetail::select($select)->select($select)->where('id',$id)->first();
    }

    public function findAboutUsDetailBySlug($slug,$with=[])
    {
        return StaticPageDetail::with($with)
            ->whereHas('page',function($query) use($slug){
                $query->where('slug',$slug);
            })
            ->where('is_active',1)
            ->latest()
            ->first();
    }

    public function getMissionAndVisionDetailBySlug($slug, $with=[])
    {
        return StaticPageDetail::with($with)
            ->whereHas('page',function($query) use($slug){
                $query->where('slug',$slug);
            })
            ->where('is_active',1)
            ->latest()
            ->take(2)
            ->get();
    }

    public function getAccreditationsPageDetailBySlug($slug,$with=[])
    {
        return StaticPageDetail::with($with)
                ->whereHas('page',function($query) use($slug){
                    $query->where('slug',$slug);
                })
                ->where('is_active',1)
                ->latest()
                ->paginate(StaticPageDetail::RECORDS_PER_PAGE);
    }

    public function getAwardsRecognitionsPageDetailBySlug($slug,$with=[])
    {
        return StaticPageDetail::with($with)
            ->whereHas('page',function($query) use($slug){
                $query->where('slug',$slug);
            })
            ->where('is_active',1)
            ->latest()
            ->paginate(StaticPageDetail::RECORDS_PER_PAGE);
    }



    public function getAllActivePageDetail($select=['*'],$with=[])
    {
        return StaticPageDetail::select($select)->with($with)
            ->where('is_active',1)
            ->latest()
            ->paginate(StaticPageDetail::RECORDS_PER_PAGE);
    }

    public function store($validatedData)
    {
        if(isset($validatedData['image'])) {
            $validatedData['image'] = $this->storeImage($validatedData['image'], StaticPageDetail::UPLOAD_PATH, 500, 500, 'static-page');
        }
        return StaticPageDetail::create($validatedData)->fresh();
    }

    public function update($staticPageDetail, $validatedData)
    {
        if(isset($validatedData['image'])){
            $this->removeImage(StaticPageDetail::UPLOAD_PATH, $staticPageDetail['image']);
            $validatedData['image'] = $this->storeImage($validatedData['image'],StaticPageDetail::UPLOAD_PATH,500,500,'static-page');
        }
        return $staticPageDetail->update($validatedData);
    }

    public function toggleStatus($id)
    {
        $staticPageDetail = $this->findStaticPageDetailById($id);
        return $staticPageDetail->update([
           'is_active' => !$staticPageDetail->is_active
        ]);
    }

    public function delete(StaticPageDetail $staticPageDetail)
    {
        $this->removeImage(StaticPageDetail::UPLOAD_PATH, $staticPageDetail['image']);
        return $staticPageDetail->delete();
    }

}
