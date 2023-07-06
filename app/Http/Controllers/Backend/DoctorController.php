<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Repositories\DepartmentRepository;
use App\Requests\doctor\DoctorAcademicRequest;
use App\Requests\doctor\DoctorRequest;
use App\Requests\doctor\DoctorSkillRequest;
use App\Requests\doctor\DoctorExperienceRequest;
use App\Services\doctor\DoctorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class DoctorController extends Controller
{
    private $view = 'backend.doctor.';

    private DoctorService $doctorService;
    private DepartmentRepository $departmentRepo;

    public function __construct(DoctorService $doctorService, DepartmentRepository $departmentRepo)
    {
        $this->doctorService = $doctorService;
        $this->departmentRepo = $departmentRepo;
    }

    public function index(Request $request)
    {
        try {
            $filterParameters = [
                'name' => $request->name ?? null,
                'email' => $request->email ?? null,
                'phone' => $request->phone ?? null,
                'department' => $request->department ?? null,
            ];
            $with = ['department:id,dept_name'];
            $select = ['doctors.*'];
            $doctors = $this->doctorService->getAllDoctorDetail($filterParameters, $select, $with);
            return view($this->view . 'index', compact('doctors', 'filterParameters'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function create()
    {
        try {
            $select = ['id', 'dept_name'];
            $departments = $this->departmentRepo->getAllActiveDepartments($select);
            return view($this->view . 'create', compact('departments'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function store(DoctorRequest           $generalDetailRequest,
                          DoctorAcademicRequest   $academicRequest,
                          DoctorSkillRequest      $skillRequest,
                          DoctorExperienceRequest $experienceRequest)
    {
        try {
            $doctorGeneralValidatedData = $generalDetailRequest->validated();
            $doctorAcademicValidatedData = $academicRequest->validated();
            $doctorSkillValidatedData = $skillRequest->validated();
            $doctorExperienceValidatedData = $experienceRequest->validated();
            DB::beginTransaction();
            $doctorDetail = $this->doctorService->storeDoctorGeneralDetail($doctorGeneralValidatedData);
            if ($doctorDetail) {
                $this->doctorService->createManyAcademicDetailOfDoctor($doctorDetail, $doctorAcademicValidatedData);
                $this->doctorService->createManySkillDetailOfDoctor($doctorDetail, $doctorSkillValidatedData);
                $this->doctorService->createManyExperienceDetailOfDoctor($doctorDetail, $doctorExperienceValidatedData);
            }
            DB::commit();
            return redirect()->back()
                ->with('success', 'New Doctor Detail Added Successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('danger', $e->getMessage())
                ->withInput();
        }
    }

    public function getDoctorAllDetail($id)
    {
        try {
            $with = ['academicDetails', 'skillDetails', 'workExperienceDetails','department'];
            $select = ['doctors.*'];
            $doctorDetails = $this->doctorService->findDoctorByDoctorId($id, $select, $with);
            $academics = $doctorDetails->academicDetails;
            $skills = $doctorDetails->skillDetails;
            $experience = $doctorDetails->workExperienceDetails;
            return view($this->view . 'show', compact('doctorDetails','academics','skills','experience'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function edit($id)
    {
        try{
            $selectDepartment = ['id', 'dept_name'];
            $departments = $this->departmentRepo->getAllDepartmentDetails($selectDepartment);
            $with = ['academicDetails', 'skillDetails', 'workExperienceDetails','department'];
            $select = ['doctors.*'];
            $doctorDetail = $this->doctorService->findDoctorByDoctorId($id, $select, $with);
            return view($this->view . 'edit', compact('doctorDetail','departments'));
        }catch(Exception $exception){
            return redirect()->back()->with('danger',$exception->getMessage());
        }
    }

    public function update(DoctorRequest           $generalRequest,
                           DoctorAcademicRequest   $academicRequest,
                           DoctorSkillRequest      $skillRequest,
                           DoctorExperienceRequest $experienceRequest, $id)
    {
        try {
            $doctorGeneralDetail =  $this->doctorService->findDoctorByDoctorId($id);
            $generalValidatedData = $generalRequest->validated();
            $academicValidatedData = $academicRequest->validated();
            $skillValidatedData = $skillRequest->validated();
            $experienceValidatedData = $experienceRequest->validated();
            DB::beginTransaction();
            $update = $this->doctorService->updateDoctorGeneralDetail($doctorGeneralDetail,$generalValidatedData);
            if ($update) {
                $secondaryDetail = $this->doctorService->deleteDoctorSecondaryDetail($doctorGeneralDetail);
                if($secondaryDetail){
                    $this->doctorService->createManyAcademicDetailOfDoctor($doctorGeneralDetail, $academicValidatedData);
                    $this->doctorService->createManySkillDetailOfDoctor($doctorGeneralDetail, $skillValidatedData);
                    $this->doctorService->createManyExperienceDetailOfDoctor($doctorGeneralDetail, $experienceValidatedData);
                }
            }
            DB::commit();
            return redirect()->back()
                ->with('success', 'Doctor Detail Updated Successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('danger', $e->getMessage())
                ->withInput();
        }
    }

    public function getDoctorGeneralDetailById($id)
    {
        try {
            $select = ['full_name','appointment_limit','id'];
            $doctorGeneralDetail = $this->doctorService->findDoctorByDoctorId($id, $select);
            return response()->json([
                'data' => $doctorGeneralDetail,
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function updateAppointmentLimitOfDoctor(Request $request ,$doctorId)
    {
        try{
            $validatedData = $request->validate([
                'appointment_limit' => 'required|numeric|min:1'
            ]);
            $doctorGeneralDetail = $this->doctorService->findDoctorByDoctorId($doctorId);
            DB::beginTransaction();
                $this->doctorService->updateDoctorGeneralDetail($doctorGeneralDetail,$validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'Doctor Appointment Limit Updated Successfully');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('danger', $e->getMessage());
        }

    }

    public function toggleStatus($id)
    {
        try {
            $this->doctorService->toggleDoctorIsActiveStatus($id);
            return redirect()->back()->with('success', 'Doctor Status changed Successfully');
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->doctorService->deleteDoctorDetail($id);
            DB::commit();
            return redirect()->back()->with('success', 'Doctor Record Trashed Successfully');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

}
