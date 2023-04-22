<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\DepartmentRepository;
use App\Repositories\DoctorRepository;
use App\Requests\doctor\DoctorScheduleRequest;
use App\Services\doctor\DoctorScheduleService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorScheduleController extends Controller
{
    private $view = 'backend.doctor.schedule.';

    private DoctorScheduleService $doctorScheduleService;
    private DoctorRepository $doctorRepository;
    private DepartmentRepository $departmentRepo;


    public function __construct(DoctorScheduleService $doctorScheduleService,
                                DoctorRepository $doctorRepository,
                                DepartmentRepository $departmentRepo
    )
    {
        $this->doctorScheduleService = $doctorScheduleService;
        $this->doctorRepository = $doctorRepository;
        $this->departmentRepo = $departmentRepo;
    }

    public function index(Request $request)
    {
        try {
            $filterParameters = [
                'name' => $request->name ?? null,
                'department' => $request->department ?? null,
            ];
            $select = ['doctors.id','doctors.full_name','doctors.dept_id'];
            $with = ['department:id,dept_name','scheduleDetails','scheduleDetails.doctorTime'];
            $doctorSchedule = $this->doctorRepository->getAllDoctorsDetail($filterParameters,$select,$with);
            return view($this->view . 'index', compact('doctorSchedule','filterParameters'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function create()
    {
        try {
            $select = ['id','dept_name'];
            $departments =  $this->departmentRepo->getAllDepartmentDetails($select);
            return view($this->view.'create',compact('departments'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function createSchedule($doctorId)
    {
        try {
            $with = [];
            $select = ['id','full_name'];
            $doctor =  $this->doctorRepository->findDoctorDetailById($doctorId,$select,$with);
            return view($this->view.'create',compact('doctor'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function getAllDoctorByDepartmentId($deptId)
    {
        try {
            $select = ['id','full_name'];
            $doctors =  $this->doctorRepository->getAllDoctorsByDeptId($deptId,$select);
            return response()->json([
                'data' => $doctors
            ]);
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function store(DoctorScheduleRequest $request)
    {
        try{
            $validatedData = $request->validated();
            DB::beginTransaction();
             $doctorWeekSchedule = $this->doctorScheduleService->storeDoctorScheduleWeekDay($validatedData);
             if($doctorWeekSchedule){
                 $this->doctorScheduleService->createManyDoctorScheduleWeekTime($doctorWeekSchedule,$validatedData['scheduleTime']);
             }
            DB::commit();
            return redirect()->back()
                ->with('success', 'New Doctor Schedule Added Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('danger', $e->getMessage())
                ->withInput();
        }
    }

    public function show($doctorId)
    {
        try {
            $select = ['*'];
            $with = ['department:id,dept_name','scheduleDetails','scheduleDetails.doctorTime'];
            $scheduleDetail = $this->doctorRepository->findDoctorDetailById($doctorId, $select,$with);
            return view($this->view.'show-detail',compact('scheduleDetail'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $select = ['*'];
            $with = ['doctorTime','doctor'];
            $scheduleDetail = $this->doctorScheduleService->findDoctorScheduleById($id,$select,$with);
            return view($this->view.'edit',compact('scheduleDetail'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function update(DoctorScheduleRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $scheduleWeekDayDetail = $this->doctorScheduleService->findDoctorScheduleById($id);
            if (!$scheduleWeekDayDetail) {
                throw new \Exception('Doctor Schedule Detail Not Found', 204);
            }
            DB::beginTransaction();
              $weekDayUpdate = $this->doctorScheduleService->updateScheduleWeekDay($scheduleWeekDayDetail, $validatedData);
              if($weekDayUpdate){
                    $this->doctorScheduleService->createManyDoctorScheduleWeekTime($scheduleWeekDayDetail,$validatedData['scheduleTime']);
              }
            DB::commit();
            return redirect()->back()->with('success', 'Doctor Schedule Detail Updated Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();
                $this->doctorScheduleService->updateAvailableWeekScheduleStatus($id);
            DB::commit();
            return redirect()->back()->with('success', 'Available Week Day Status changed Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $scheduleDetail = $this->doctorScheduleService->getAllWeekDayScheduleByDoctorId($id);
            DB::beginTransaction();
                $this->doctorScheduleService->delete($scheduleDetail);
            DB::commit();
            return redirect()->back()->with('success', 'Doctor WeekDay Schedule Detail Deleted  Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

}
