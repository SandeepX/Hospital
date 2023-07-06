<?php

namespace App\Repositories;

use App\Models\Gallery;
use App\Traits\ImageService;

class GalleryRepository
{
    use ImageService;

    public function getAllGalleryDetail($select = ['*']): mixed
    {
        return Gallery::select($select)->latest()->simplePaginate(Gallery::RECORDS_PER_PAGE);
    }

    public function getAllActiveGalleries($select = ['*'])
    {
        return Gallery::select($select)->where('is_active', 1)->get();
    }

    public function getGalleryImageForWelcomePage($select= ['*'])
    {
        return Gallery::select($select)->where('is_active', 1)->latest()->take(6)->get();
    }

    public function store($validatedData): mixed
    {
        $validatedData['image'] = $this->storeImage($validatedData['image'], Gallery::UPLOAD_PATH, 500, 500, 'gallery');
        return Gallery::create($validatedData)->fresh();
    }

    public function toggleStatus($id): mixed
    {
        $galleryDetail = $this->findGalleryDetailById($id);
        return $galleryDetail->update([
            'is_active' => !$galleryDetail->is_active,
        ]);
    }

    public function findGalleryDetailById($id, $select = ['*']): mixed
    {
        return Gallery::select($select)->where('id', $id)->first();
    }

    public function update($galleryDetail, $validatedData)
    {
        if (isset($validatedData['image'])) {
            $this->removeImage(Gallery::UPLOAD_PATH, $galleryDetail['image']);
            $validatedData['image'] = $this->storeImage($validatedData['image'], Gallery::UPLOAD_PATH, 500, 500, 'gallery');
        }
        return $galleryDetail->update($validatedData);
    }

    public function delete(Gallery $gallery)
    {
        $this->removeImage(Gallery::UPLOAD_PATH, $gallery['image']);
        return $gallery->delete();
    }

}
