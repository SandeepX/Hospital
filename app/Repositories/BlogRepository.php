<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Traits\ImageService;

class BlogRepository
{
    use ImageService;

    public function getAllBlogDetail($select=['*'],$with=[])
    {
        return Blog::select($select)->with($with)->latest()->paginate(Blog::RECORDS_PER_PAGE);
    }

    public function findBlogById($id, $select=['*'],$with=[])
    {
        return Blog::with($with)->select($select)->where('id',$id)->first();
    }

    public function getLatestPublishedBlogs($select=['*'],$with=[])
    {
        return Blog::with($with)
            ->select($select)
            ->where('status',1)
            ->latest()
            ->take(6)
            ->get();
    }

    public function getAllActiveBlogs($select=['*'],$with=[])
    {
        return Blog::select($select)->with($with)
            ->where('status',1)
            ->latest()
            ->paginate(Blog::RECORDS_PER_PAGE);
    }

    public function store($validatedData)
    {
        $validatedData['image'] = $this->storeImage($validatedData['image'], Blog::UPLOAD_PATH, 500, 500, 'blog');
        return Blog::create($validatedData)->fresh();
    }

    public function update($blogDetail, $validatedData)
    {
        if(isset($validatedData['image'])){
            $this->removeImage(Blog::UPLOAD_PATH, $blogDetail['image']);
            $validatedData['image'] = $this->storeImage($validatedData['image'],Blog::UPLOAD_PATH,500,500,'blog');
        }
        return $blogDetail->update($validatedData);
    }

    public function toggleStatus($id)
    {
        $blogDetail = $this->findBlogById($id);
        return $blogDetail->update([
            'status' => !$blogDetail->status
        ]);
    }

    public function delete(Blog $blogDetail)
    {
        $this->removeImage(Blog::UPLOAD_PATH, $blogDetail['image']);
        return $blogDetail->delete();
    }

}
