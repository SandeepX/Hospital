<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Requests\appointment\AppointmentRequest;
use App\Services\doctor\DoctorAppointmentService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    private $view = 'backend.appointment.';

    private DoctorAppointmentService $appointmentService;

    public function __construct(DoctorAppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function index(Request $request)
    {
        try {
            $filterParameters = [
                'patient_name'=> $request->patient_name ?? null,
                'doctor_name'=> $request->doctor_name ?? null,
                'appointment_date'=> $request->appointment_date ?? null,
                'contact_no'=> $request->contact_no ?? null,
                'status'=> $request->status ?? null,
            ];
            $appointments = $this->appointmentService->getAllAppointments($filterParameters);
            return view($this->view . 'index', compact('appointments','filterParameters'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }


    public function show($id)
    {
        try {
            $select = ['*'];
            $detail = $this->appointmentService->findAppointmentDetailById($id, $select);
            $detail->department_name = ucfirst($detail->department->dept_name);
            $detail->gender = ucfirst($detail->gender);
            $detail->patients_name = ucfirst($detail->patients_name);
            $detail->doctor_name = ucfirst($detail->doctor->full_name);
            $detail->time = AppHelper::timeInTwelveHourFormat($detail->appointmentTime->time_from) .' - '.  AppHelper::timeInTwelveHourFormat($detail->appointmentTime->time_to);
            return response()->json([
                'data' => $detail,
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $select = ['patients_name','status','id'];
            $detail = $this->appointmentService->findAppointmentDetailById($id, $select);
            $detail->name  = ucfirst($detail->patients_name);
            return response()->json([
                'data' => $detail,
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function updateAppointmentRequestStatus(Request $request,$id)
    {
        try {
            $validatedData =  $request->validate([
                'status' => ['required',Rule::in(Appointment::STATUS)]
            ]);
            $appointmentDetail = $this->appointmentService->findAppointmentDetailById($id,['*']);
            DB::beginTransaction();
                $this->appointmentService->updateAppointmentStatus($appointmentDetail,$validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'Appointment Detail Updated !');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $select = ['*'];
            $appointmentDetail = $this->appointmentService->findAppointmentDetailById($id,$select);
            DB::beginTransaction();
                $this->appointmentService->deleteAppointment($appointmentDetail);
            DB::commit();
            return redirect()->back()->with('success', 'Appointment Detail Deleted !');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }
}
