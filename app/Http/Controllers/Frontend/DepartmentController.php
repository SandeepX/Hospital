<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\DepartmentRepository;
use App\Repositories\DoctorRepository;
use App\Repositories\HospitalServiceRepository;
use App\Repositories\PagesRepository;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    private DepartmentRepository $departmentRepo;
    private PagesRepository $pagesRepo;
    private HospitalServiceRepository $serviceRepo;
    private DoctorRepository $doctorRepository;

    public function __construct(DepartmentRepository $departmentRepo,
                                PagesRepository $pagesRepo,
                                HospitalServiceRepository $serviceRepo,
                                DoctorRepository $doctorRepository)
    {
        $this->departmentRepo = $departmentRepo;
        $this->pagesRepo = $pagesRepo;
        $this->serviceRepo = $serviceRepo;
        $this->doctorRepository = $doctorRepository;
    }

    public function index(Request $request)
    {
        try {
            $select = ['id','dept_name','dept_opened','image','description','png_class','position'];
            $slug = 'departments';
            $departments = $this->departmentRepo->getAllActiveDepartments($select);
            $pageDetail =  $this->pagesRepo->findPageDetailBYPageSlug($slug);
            return view('frontend.department.index', compact('departments','pageDetail'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger',$exception->getMessage());
        }
    }

    public function getDepartmentDetailById($departmentId)
    {
        try{
            $selectDepartment = ['id','dept_name'];
            $departments = $this->departmentRepo->getAllActiveDepartments($selectDepartment);
            $departmentDetail = $this->departmentRepo->findDepartmentDetailById($departmentId);
            $doctors = $this->doctorRepository->getAllDoctorsByDeptId($departmentDetail->id);

            return view('frontend.department.department-detail',compact('departmentDetail','departments' , 'doctors'));
        }catch(\Exception $ex){
            return redirect()->back()->with('danger', $ex->getMessage());
        }
    }


}
