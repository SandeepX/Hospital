<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\DoctorRepository;
use App\Repositories\HospitalServiceRepository;
use App\Repositories\MediaLinkRepository;
use App\Repositories\StaticPageDetailRepository;
use App\Repositories\TestimonialRepository;

class ContentManagementController extends Controller
{
    private $view = 'frontend.contentManagement.';

    private  StaticPageDetailRepository $pageDetailRepo;
    private  MediaLinkRepository $mediaLinkRepo;
    private   DoctorRepository $doctorRepo;
    private   TestimonialRepository $testimonialRepo;

    public function __construct(StaticPageDetailRepository $pageDetailRepo,MediaLinkRepository $mediaLinkRepo,
                                    DoctorRepository $doctorRepo,TestimonialRepository $testimonialRepo,HospitalServiceRepository $serviceRepo,
    )
    {
        $this->pageDetailRepo = $pageDetailRepo;
        $this->mediaLinkRepo = $mediaLinkRepo;
        $this->doctorRepo = $doctorRepo;
        $this->testimonialRepo = $testimonialRepo;
        $this->serviceRepo = $serviceRepo;
    }

    public function getAboutUsPageDetail()
    {
        try{
            $pageWith = ['page'];
            $aboutUsDetail = $this->pageDetailRepo->findAboutUsDetailBySlug('about-us',$pageWith);
            $missionAndVision = $this->pageDetailRepo->getMissionAndVisionDetailBySlug('our-mission-vision',$pageWith);
            $directorMessage = $this->pageDetailRepo->findAboutUsDetailBySlug('managing-director',$pageWith);
            $video = $this->mediaLinkRepo->findActiveMediaLinkByType('video',['url']);
            $doctors = $this->doctorRepo->getActiveDoctorsDetail();
            $testimonial = $this->testimonialRepo->getAllPublishedTestimonials();
            $quickServices = $this->serviceRepo->getAllActiveQuickServicesHospitalServices();
            return view($this->view.'about-us',compact(
                    'aboutUsDetail','missionAndVision', 'video',
                    'doctors','testimonial','directorMessage','quickServices'
                )
            );
        }catch(\Exception $e){
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    public function getMissionVisionPageDetail()
    {
        try{
            $pageWith = ['page'];
            $missionAndVision = $this->pageDetailRepo->getMissionAndVisionDetailBySlug('our-mission-vision',$pageWith);
            $aboutUsDetail = $this->pageDetailRepo->findAboutUsDetailBySlug('about-us',$pageWith);
            $video = $this->mediaLinkRepo->findActiveMediaLinkByType('video',['url']);
            $quickServices = $this->serviceRepo->getAllActiveQuickServicesHospitalServices();
            return view($this->view.'mission-vision',compact(
                    'aboutUsDetail','missionAndVision', 'video','quickServices'
                )
            );
        }catch(\Exception $exception){
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function getManagingDirectorPageDetail()
    {
        try{
            $pageWith = ['page'];
            $directorMessageDetail = $this->pageDetailRepo->findAboutUsDetailBySlug('managing-director',$pageWith);
            $aboutUsDetail = $this->pageDetailRepo->findAboutUsDetailBySlug('about-us',$pageWith);
            $quickServices = $this->serviceRepo->getAllActiveQuickServicesHospitalServices();
            return view($this->view.'managing-director',compact(
                    'aboutUsDetail','directorMessageDetail', 'quickServices'
                )
            );
        }catch(\Exception $exception){
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function getAccreditationsPageDetail()
    {
        try{
            $pageWith = ['page'];
            $accreditations = $this->pageDetailRepo->getAccreditationsPageDetailBySlug('accreditations',$pageWith);
            return view($this->view.'accreditations',compact(
                    'accreditations'                )
            );
        }catch(\Exception $exception){
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function getAwardRecognitionsPageDetail()
    {
        try{
            $pageWith = ['page'];
            $awards = $this->pageDetailRepo->getAwardsRecognitionsPageDetailBySlug('awards-recognitions',$pageWith);
            return view($this->view.'awards-recognition',compact(
                    'awards' )
            );
        }catch(\Exception $exception){
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }
}
