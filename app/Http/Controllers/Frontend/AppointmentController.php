<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Repositories\DepartmentRepository;
use App\Repositories\DoctorRepository;
use App\Requests\appointment\AppointmentRequest;
use App\Services\doctor\DoctorAppointmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;

class AppointmentController extends Controller
{
    private DepartmentRepository $departmentRepo;
    private DoctorRepository $doctorRepo;
    private DoctorAppointmentService $appointmentService;

    public function __construct(DepartmentRepository $departmentRepo,
                                DoctorRepository $doctorRepo,DoctorAppointmentService $appointmentService)
    {
        $this->departmentRepo = $departmentRepo;
        $this->doctorRepo = $doctorRepo;
        $this->appointmentService = $appointmentService;
    }

    public function getAllActiveDepartments()
    {
        try {
            $select = ['id', 'dept_name'];
            $departments = $this->departmentRepo->getAllActiveDepartments($select);
            return response()->json([
                'data' => $departments
            ]);
        } catch (\Exception $ex) {
            return redirect()->back()->with('danger', $ex->getMessage());
        }
    }

    public function getAllActiveDoctorByDeptId($deptId)
    {
        try{
            $select = ['id', 'full_name'];
            $doctors = $this->doctorRepo->getAllDoctorsByDeptId($deptId,$select);
            return response()->json([
                'data' => $doctors
            ]);
        }catch(\Exception $ex){
            return redirect()->back()->with('danger', $ex->getMessage());
        }
    }

    public function getDoctorAvailableDate($doctorId)
    {
        try{
            $weekDays = [];
            $doctorWeekDay = $this->doctorRepo->getDoctorAllAvailableWeekDays($doctorId,['available_week_day']);
            if(!empty($doctorWeekDay)){
                foreach($doctorWeekDay as $key => $value){
                    array_push($weekDays,$value->available_week_day);
                }
            }
            $now = Carbon::now();
            $monthStartDate = $now->format('d-m-Y');
            $monthEndDate = $now->startOfMonth()->addMonth(1)->format('d-m-Y');
            $requiredDays = $this->weekDaysBetween($weekDays,$monthStartDate,$monthEndDate);
            return response()->json([
               'data' => $requiredDays
            ]);
        }catch(Exception $ex){
            return redirect()->back()->with('danger', $ex->getMessage());
        }
    }

    public function getDoctorTimeByDoctorId(Request $request,$doctorId)
    {
        try{
            $date = $request->date;
            $weekDay = date('w', strtotime($date));
            $with = ['doctorTime'];
            $select = ['doctor_schedules.*'];
            $doctorTime = $this->doctorRepo->getDoctorOPDTime($doctorId,$weekDay,$select,$with);
            $timeDetail = $doctorTime?->doctorTime()->get() ?? [];
            return response()->json([
                'data' => $timeDetail
            ]);
        }catch(\Exception $ex){
            return redirect()->back()->with('danger', $ex->getMessage());
        }
    }

    public function store(AppointmentRequest $request)
    {
        try {
            $validatedData = $request->validated();
            DB::beginTransaction();
            $this->appointmentService->store($validatedData);
            DB::commit();
            return AppHelper::sendSuccessResponse('Appointment Request Submitted Successfully.',[]);
        } catch (Exception $e) {
            DB::rollBack();
            return AppHelper::sendErrorResponse($e->getMessage(), $e->getCode());
        }
    }

    private function weekDaysBetween($requiredDays, $start, $end)
    {
        try {
            $startTime = Carbon::createFromFormat('d-m-Y', $start);
            $endTime = Carbon::createFromFormat('d-m-Y', $end);
            $result = [];
            while ($startTime->lt($endTime)) {
                if(in_array($startTime->dayOfWeek, $requiredDays)){
                    array_push($result, ($startTime->copy())->format('Y-m-d'));
                }
                $startTime->addDay();
            }
            return $result;
         }catch(Exception $ex) {
            throw $ex;
//            dd($ex->getMessage());
        }

    }

    public function appointmentCreate()
    {
        return view('frontend.appointment');
    }



}

