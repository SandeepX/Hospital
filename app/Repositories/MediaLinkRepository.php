<?php

namespace App\Repositories;

use App\Models\MediaLink;

class MediaLinkRepository
{
    public function getAllMediaLink($select=['*'],$with=[])
    {
        return MediaLink::select($select)->with($with)->latest()->paginate(MediaLink::RECORDS_PER_PAGE);
    }

    public function findMediaLinkById($id, $select=['*'])
    {
        return MediaLink::select($select)->select($select)->where('id',$id)->first();
    }

    public function getAllActiveMediaLink($select=['*'],$with=[])
    {
        return MediaLink::select($select)->with($with)
            ->where('is_active',1)
            ->latest()
            ->paginate(MediaLink::RECORDS_PER_PAGE);
    }

    public function findActiveMediaLinkByType($linkType,$select=['*'])
    {
        $video = MediaLink::select($select)->where('is_active',1)
            ->where('link_type',$linkType)
            ->latest()
            ->first();
        if($linkType === 'image_360'){
            return $video;
        }
        $url = $video->url ?? '';
        $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
        preg_match($pattern, $url, $matches);
        return  (isset($matches[1])) ? $matches[1] : false;
    }


    public function store($validatedData)
    {
        return MediaLink::create($validatedData)->fresh();
    }

    public function update($mediaLinkDetail, $validatedData)
    {
        return $mediaLinkDetail->update($validatedData);
    }

    public function toggleStatus($id)
    {
        $mediaLinkDetail = $this->findMediaLinkById($id);
        return $mediaLinkDetail->update([
            'is_active' => !$mediaLinkDetail->is_active
        ]);
    }

    public function delete(MediaLink $mediaLinkDetail)
    {
        return $mediaLinkDetail->delete();
    }

}
