<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Traits\ImageService;

class BannerRepository
{
    use ImageService;

    public function getAllBanner($select = ['*'], $with = [])
    {
        return Banner::select($select)->with($with)->latest()->paginate(Banner::RECORDS_PER_PAGE);
    }

    public function findBannerById($id, $select = ['*'])
    {
        return Banner::select($select)->select($select)->where('id', $id)->first();
    }

    public function findActiveAdBanner($select=['*'])
    {
        return Banner::select($select)->select($select)
            ->where('banner_type','AD_Banner')
            ->where('is_active',1)
            ->latest()
            ->first();
    }

    public function getActiveNormalBanner($select=['*'])
    {
        return Banner::select($select)->select($select)
            ->where('banner_type','Normal_Banner')
            ->where('is_active',1)
            ->latest()
            ->take(3)
            ->get();
    }

    public function getAllActiveBannerDetail($select = ['*'], $with = [])
    {
        return Banner::select($select)->with($with)
            ->where('is_active', 1)
            ->latest()
            ->paginate(Banner::RECORDS_PER_PAGE);
    }

    public function store($validatedData)
    {
        if (isset($validatedData['image'])) {
            $validatedData['image'] = $this->storeImage($validatedData['image'], Banner::UPLOAD_PATH, 500, 500, 'banner');
        }
        return Banner::create($validatedData)->fresh();
    }

    public function update($bannerDetail, $validatedData)
    {
        if (isset($validatedData['image'])) {
            $this->removeImage(Banner::UPLOAD_PATH, $bannerDetail['image']);
            $validatedData['image'] = $this->storeImage($validatedData['image'], Banner::UPLOAD_PATH, 500, 500, 'banner');
        }
        return $bannerDetail->update($validatedData);
    }


    public function toggleStatus($id)
    {
        $bannerDetail = $this->findBannerById($id);
        return $bannerDetail->update([
            'is_active' => !$bannerDetail->is_active
        ]);
    }

    public function delete(Banner $bannerDetail)
    {
        $this->removeImage(Banner::UPLOAD_PATH, $bannerDetail['image']);
        return $bannerDetail->delete();
    }

}

