<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\DepartmentRepository;
use App\Repositories\DoctorPageSettingRepository;
use App\Services\doctor\DoctorService;
use Exception;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    private $view = 'frontend.doctor.';

    private DoctorService $doctorService;
    private DoctorPageSettingRepository $doctorPageSettingRepo;
    private DepartmentRepository $departmentRepo;


    public function __construct(DoctorService $doctorService,
                                DoctorPageSettingRepository $doctorPageSettingRepo,
                                DepartmentRepository $departmentRepo)
    {
        $this->doctorService = $doctorService;
        $this->doctorPageSettingRepo = $doctorPageSettingRepo;
        $this->departmentRepo = $departmentRepo;
    }

    public function index(Request $request)
    {
       try{
           $filterParameter = [
               'name' => $request->name ?? null
           ];
           $with = ['doctors:id,full_name,dept_id,fb_link,insta_link,twitter_link,speciality,avatar',];
           $select = ['departments.id','departments.dept_name','departments.is_active'];
           $departments = $this->departmentRepo->getActiveDepartmentsWithDoctors($filterParameter,$select,$with);
           return view($this->view.'doctor-list',compact('departments','filterParameter') );
       }catch(Exception $exception){
           return redirect()->back()->with('danger', $exception->getMessage());
       }
    }

    public function getDoctorDetailByDoctorId($doctorId)
    {
        try{
            $with = ['academicDetails', 'skillDetails', 'workExperienceDetails','scheduleDetails','scheduleDetails.doctorTime','department'];
            $select = ['doctors.*'];
            $doctorDetails = $this->doctorService->findDoctorByDoctorId($doctorId, $select, $with);
            $doctorPage = $this->doctorPageSettingRepo->getDoctorPageSettingDetail();
            $academics = $doctorDetails->academicDetails;
            $skills = $doctorDetails->skillDetails;
            $experience = $doctorDetails->workExperienceDetails;
            $availableDays = $doctorDetails->scheduleDetails;
            return view($this->view.'doctor-detail',compact('doctorDetails','academics','skills',
                'experience','availableDays','doctorPage')
            );
        }catch(\Exception $exception){
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function getAllActiveDoctor()
    {
        try {
            $select = ['id', 'full_name'];
            $doctors = $this->doctorService->getAllActiveDoctorDetail($select) ?? [];
            return response()->json([
                'data' => $doctors
            ]);
        } catch (\Exception $ex) {
            return redirect()->back()->with('danger', $ex->getMessage());
        }
    }
}
