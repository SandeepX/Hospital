<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\GalleryRepository;
use App\Repositories\MediaLinkRepository;
use Exception;

class GalleryController extends Controller
{

    private MediaLinkRepository $mediaLinkRepo;
    private GalleryRepository $galleryRepo;

    public function __construct(MediaLinkRepository $mediaLinkRepo, GalleryRepository $galleryRepo)
    {
        $this->mediaLinkRepo = $mediaLinkRepo;
        $this->galleryRepo = $galleryRepo;
    }

    public function index()
    {
        try {
            $galleryImage = $this->galleryRepo->getAllGalleryDetail(['id', 'title', 'image']);
            $image = $this->mediaLinkRepo->findActiveMediaLinkByType('image_360', ['url']);
            return view('frontend.gallery', compact('galleryImage', 'image'));
        } catch (Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
}

