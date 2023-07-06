<?php

namespace App\Services\doctor;

use App\Repositories\AppointmentRepository;
use App\Repositories\DoctorRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class DoctorAppointmentService
{

    private AppointmentRepository $appointmentRepo;
    private DoctorRepository $doctorRepo;

    public function __construct(AppointmentRepository $appointmentRepo,DoctorRepository $doctorRepo)
    {
        $this->appointmentRepo = $appointmentRepo;
        $this->doctorRepo = $doctorRepo;
    }

    public function getAllAppointments($filterParameters)
    {
        try {
            return $this->appointmentRepo->getAllAppointmentLists($filterParameters);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function findAppointmentDetailById($id,$select)
    {
        try {
            $appointmentDetail = $this->appointmentRepo->findAppointmentsDetailById($id,$select);
            if(!$appointmentDetail){
                throw new Exception('Appointment Detail Not Found',204);
            }
            return $appointmentDetail;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function store($validatedData)
    {
        try {
            $select = ['appointment_limit'];
            $doctorDetail = $this->doctorRepo->findDoctorDetailById($validatedData['doctor_id'],$select);
            $doctorTodayAppointmentCount = $this->countDoctorTodayAppointment($validatedData['doctor_id']);
            if($doctorTodayAppointmentCount >= $doctorDetail->appointment_limit ?? 0){
                throw new Exception('Doctor Appointment Limit For the Day Exceeded',400);
            }
            DB::beginTransaction();
                $appointmentRequest = $this->appointmentRepo->store($validatedData);
            DB::commit();
            return $appointmentRequest;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateAppointmentStatus($appointmentDetail,$validatedData)
    {
        try {
            DB::beginTransaction();
                $appointmentRequest = $this->appointmentRepo->updateAppointmentStatus($appointmentDetail,$validatedData);
            DB::commit();
            return $appointmentRequest;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteAppointment($appointmentDetail)
    {
        try{
            DB::beginTransaction();
                $this->appointmentRepo->delete($appointmentDetail);
            DB::commit();
            return;
        }catch (Exception $exception){
            DB::rollBack();
            throw $exception;
        }

    }

    public function countDoctorTodayAppointment($doctorId)
    {
        try{
           return $this->appointmentRepo->getCountOfDoctorTodayAppointment($doctorId);
        }catch(Exception $exception){
            throw $exception;
        }

    }


}
