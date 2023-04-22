<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Repositories\ContactUsRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\HospitalProfileRepository;
use App\Requests\contactUs\ContactUsRequest;
use App\Resources\Comment\TaskCommentResource;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ContactUsController extends Controller
{

    private HospitalProfileRepository $hospitalRepo;
    private DepartmentRepository $departmentRepo;
    private ContactUsRepository $contactUsRepo;

    public function __construct(HospitalProfileRepository $hospitalRepo,
                                DepartmentRepository      $departmentRepo,
                                ContactUsRepository       $contactUsRepo)
    {
        $this->hospitalRepo = $hospitalRepo;
        $this->departmentRepo = $departmentRepo;
        $this->contactUsRepo = $contactUsRepo;
    }

    public function getContactUsPage()
    {
        try {
            $selectHospitalValue = ['phone_one', 'phone_two', 'email', 'address', 'location_lat', 'location_long'];
            $selectDeptValue = ['id', 'dept_name'];
            $hospital = $this->hospitalRepo->getHospitalProfileDetail($selectHospitalValue);
            $departments = $this->departmentRepo->getAllActiveDepartments($selectDeptValue);
            $gender = ContactUs::GENDER;
            return view('frontend.contact-us', compact('hospital',
                    'departments', 'gender'
                )
            );
        } catch (Exception $e) {
            return back()->with('danger', $e->getMessage());
        }
    }

    public function store(ContactUsRequest $request)
    {
        try {
            $validatedData = $request->validated();
            DB::beginTransaction();
            $this->contactUsRepo->store($validatedData);
            DB::commit();
            return AppHelper::sendSuccessResponse('Query Submitted Successfully',[]);
        } catch (Exception $e) {
            DB::rollBack();
            return AppHelper::sendErrorResponse($e->getMessage(), $e->getCode());
        }
    }
}
