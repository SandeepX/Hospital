<?php

namespace App\Repositories;

use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentRepository
{
    public function getAllAppointmentLists($filterParameters,$select = ['*'],$with=[]): mixed
    {
        return Appointment::select($select)->with($with)
            ->when(isset($filterParameters['patient_name']),function($query) use ($filterParameters){
                $query->where('patients_name', 'like', '%' . $filterParameters['patients_name'] . '%');
            })
            ->when(isset($filterParameters['contact_no']),function($query) use ($filterParameters){
                $query->where('contact_no',  $filterParameters['contact_no']);
            })
            ->when(isset($filterParameters['status']),function($query) use ($filterParameters){
                $query->where('status',  $filterParameters['status']);
            })
            ->when(isset($filterParameters['appointment_date']),function($query) use ($filterParameters){
                $query->whereDate('appointment_date',  $filterParameters['appointment_date']);
            })
            ->when(isset($filterParameters['doctor_name']),function($query) use ($filterParameters){
                $query->whereHas('doctor', function($doctor) use ($filterParameters){
                    $doctor->where('full_name', 'like', '%' . $filterParameters['doctor_name'] . '%');
                });
            })
            ->latest()
            ->paginate(Appointment::RECORDS_PER_PAGE);
    }

    public function store($validatedData): mixed
    {
        return Appointment::create($validatedData)->fresh();
    }

    public function updateAppointmentStatus($appointmentDetail,$validatedData)
    {
        return $appointmentDetail->update([
            'status' => $validatedData['status']
        ]);
    }

    public function getCountOfDoctorTodayAppointment($doctorId)
    {
        return Appointment::where('doctor_id', $doctorId)
            ->where('appointment_date',Carbon::now()->format('Y-m-d'))
            ->count();
    }

    public function findAppointmentsDetailById($id, $select = ['*'],$with=[]): mixed
    {
        return Appointment::select($select)->with($with)->where('id', $id)->first();
    }

    public function delete(Appointment $appointmentDetail)
    {
        return $appointmentDetail->delete();
    }
}
