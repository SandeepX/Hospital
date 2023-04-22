<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\DepartmentRepository;
use App\Repositories\ExtraServiceRepository;
use App\Repositories\HospitalServiceRepository;
use App\Repositories\PagesRepository;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private HospitalServiceRepository $serviceRepo;
    private ExtraServiceRepository $extraServiceRepo;

    public function __construct(HospitalServiceRepository $serviceRepo,ExtraServiceRepository $extraServiceRepo)
    {
        $this->serviceRepo = $serviceRepo;
        $this->extraServiceRepo = $extraServiceRepo;
    }

    public function index(Request $request)
    {
        try {
            $services = $this->serviceRepo->getAllActiveHospitalServices();
            $additionalServices = $this->extraServiceRepo->getAllActiveExtraServices();
            return view('frontend.service.index', compact('services','additionalServices'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function getServiceDetailById($serviceId)
    {
        try{
            $selectService = ['id','name'];
            $services =  $this->serviceRepo->getAllActiveHospitalServices($selectService);
            $serviceDetail =  $this->serviceRepo->findHospitalServiceDetailById($serviceId);
            return view('frontend.service.show',compact('services','serviceDetail'));
        }catch(\Exception $ex){
            return redirect()->back()->with('danger', $ex->getMessage());
        }
    }
}
