<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Repositories\BannerRepository;
use App\Repositories\DoctorRepository;
use App\Repositories\EventRepository;
use App\Repositories\GalleryRepository;
use App\Repositories\HospitalServiceRepository;
use App\Repositories\MediaLinkRepository;
use App\Repositories\StaticPageDetailRepository;
use App\Repositories\TestimonialRepository;
use Exception;
use Illuminate\Http\Request;

class WelcomePageController extends Controller
{

    private BannerRepository $bannerRepo;
    private StaticPageDetailRepository $staticPageDetailRepo;
    private DoctorRepository $doctorRepo;
    private HospitalServiceRepository $serviceRepo;
    private MediaLinkRepository $mediaLinkRepo;
    private GalleryRepository $galleryRepo;
    private EventRepository $eventRepo;
    private TestimonialRepository $testimonialRepo;

    public function __construct(BannerRepository    $bannerRepo, StaticPageDetailRepository $staticPageDetailRepo,
                                DoctorRepository    $doctorRepo, HospitalServiceRepository $serviceRepo,
                                MediaLinkRepository $mediaLinkRepo, GalleryRepository $galleryRepo,
                                EventRepository     $eventRepo, TestimonialRepository $testimonialRepo

    )
    {
        $this->bannerRepo = $bannerRepo;
        $this->serviceRepo = $serviceRepo;
        $this->staticPageDetailRepo = $staticPageDetailRepo;
        $this->doctorRepo = $doctorRepo;
        $this->mediaLinkRepo = $mediaLinkRepo;
        $this->galleryRepo = $galleryRepo;
        $this->eventRepo = $eventRepo;
        $this->testimonialRepo = $testimonialRepo;
    }

    public function getAllWelcomePageData(Request $request)
    {

            $selectBanner = ['title', 'sub_title', 'image'];
            $pageWith = ['page'];
            $banner = $this->bannerRepo->getActiveNormalBanner($selectBanner);
            $aboutUsDetail = $this->staticPageDetailRepo->findAboutUsDetailBySlug('about-us', $pageWith);
            $missionAndVision = $this->staticPageDetailRepo->getMissionAndVisionDetailBySlug('our-mission-vision', $pageWith);
            $doctors = $this->doctorRepo->getActiveDoctorsDetail();
            $services = $this->serviceRepo->getAllActiveHospitalServices();
            $quickServices = $this->serviceRepo->getAllActiveQuickServicesHospitalServices();
            $galleryImage = $this->galleryRepo->getGalleryImageForWelcomePage(['id', 'title', 'image']);
            $events = $this->eventRepo->getLatestSixEvents();
            $testimonial = $this->testimonialRepo->getAllPublishedTestimonials();
            $adBanner = $this->bannerRepo->findActiveAdBanner($selectBanner);
            $adBanner_image= null;
            if($adBanner){
                $adBanner_image = asset(Banner::UPLOAD_PATH.$adBanner?->image);
            }

            return view('frontend.welcome', compact(
                    'banner', 'aboutUsDetail',
                    'doctors',
                    'services',
                    'missionAndVision',
                    'galleryImage',
                    'events',
                    'quickServices',
                    'adBanner_image',
                    'testimonial')
            );

    }

    public function getImage360()
    {
        try{
            $linkType = 'image_360';
            $select = ['url'];
            $image = $this->mediaLinkRepo->findActiveMediaLinkByType($linkType, $select);
            $image->url = $image->url ?? 'https://kuula.co/share/collection/7vXY5?logo=1&info=1&fs=1&vr=0&sd=1&thumbs=1';
            return response()->json([
                'data' => $image->url
            ]);
        }catch(\Exception $ex){
            return redirect()->back()->with('danger', $ex->getMessage());
        }
    }

    public function video()
    {
        try{
            $linkType = 'video';
            $select = ['url'];
            $video_id = $this->mediaLinkRepo->findActiveMediaLinkByType($linkType, $select);
            return response()->json([
                'data' => $video_id
            ]);
        }catch(\Exception $ex){
            return redirect()->back()->with('danger', $ex->getMessage());
        }
    }

    public function getAdBanner()
    {
            $selectBanner = ['title', 'sub_title', 'image'];
            $adBanner = $this->bannerRepo->findActiveAdBanner($selectBanner);
            $adBanner->image = asset(Banner::UPLOAD_PATH.'Thumb-'.$adBanner->image);
            return response()->json([
                'data' => $adBanner->image
            ]);
    }

}
