<?php

namespace App\Repositories;

use App\Models\Download;
use App\Traits\ImageService;

class DownloadRepository
{
    use ImageService;

    public function getAllDownloadableFile($select=['*'])
    {
        return Download::select($select)->latest()->paginate(Download::RECORDS_PER_PAGE);
    }

    public function getAllActiveDowloadAbleFile($select=['*'])
    {
        return Download::select($select)
            ->where('is_active',1)
            ->latest()
            ->get();
    }

    public function store($validatedData)
    {
        $validatedData['file'] = $this->storeImage($validatedData['file'],Download::UPLOAD_PATH,500,500);
        return Download::create($validatedData)->fresh();
    }

    public function findDownloadableFileDetailById($id, $select = ['*']): mixed
    {
        return Download::select($select)->where('id', $id)->first();
    }

    public function toggleStatus($id): mixed
    {
        $fileDetail = $this->findDownloadableFileDetailById($id);
        return $fileDetail->update([
            'is_active' => !$fileDetail->is_active,
        ]);
    }

    public function delete(Download $fileDetail)
    {
        $this->removeImage(Download::UPLOAD_PATH, $fileDetail['file']);
        return $fileDetail->delete();
    }



}
