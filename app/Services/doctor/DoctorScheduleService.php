<?php

namespace App\Services\doctor;

use App\Repositories\DoctorRepository;
use App\Repositories\DoctorScheduleRepository;
use Illuminate\Support\Facades\DB;

class DoctorScheduleService
{
    private DoctorScheduleRepository $doctorScheduleRepo;

    public function __construct(DoctorScheduleRepository $doctorScheduleRepo)
    {
        $this->doctorScheduleRepo = $doctorScheduleRepo;
    }

    public function getAllWeekDayScheduleByDoctorId($doctorId)
    {
        try{
            $doctorSchedule =  $this->doctorScheduleRepo->getAllDoctorScheduleByDoctorId($doctorId);
            if($doctorSchedule->count() == 0){
                throw new \Exception('Schedule Detail Not Found',204);
            }
            return $doctorSchedule;
        }catch(\Exception $exception){
            throw $exception;
        }
    }


    public function storeDoctorScheduleWeekDay($validatedData)
    {
        try{
            DB::beginTransaction();
                $scheduleWeekDay = $this->doctorScheduleRepo->store($validatedData);
            DB::commit();
            return $scheduleWeekDay;
        }catch(\Exception $e){
            throw $e;
        }
    }

    public function createManyDoctorScheduleWeekTime($scheduleDetail,$validatedTimeData)
    {
        try{
            DB::beginTransaction();
             $this->doctorScheduleRepo->createManyDoctorScheduleTime($scheduleDetail,$validatedTimeData);
            DB::commit();
            return ;
        }catch(\Exception $e){
            throw $e;
        }
    }

    public function updateScheduleWeekDay($scheduleWeekDayDetail,$validatedData)
    {
        try{
            DB::beginTransaction();
            $scheduleWeekDay = $this->doctorScheduleRepo->update($scheduleWeekDayDetail,$validatedData);
            DB::commit();
            return $scheduleWeekDay;
        }catch(\Exception $e){
            throw $e;
        }
    }

    public function findDoctorScheduleById($id,$select=['*'],$with=[])
    {
        try{
            $weekDayScheduleDetail = $this->doctorScheduleRepo->findDoctorScheduleById($id,$select,$with);
            if (!$weekDayScheduleDetail) {
                throw new \Exception('Record Not Found', 204);
            }
            return $weekDayScheduleDetail;
        }catch(\Exception $e){
            throw $e;
        }
    }

    public function updateAvailableWeekScheduleStatus($id)
    {
        try{
            $scheduleDetail = $this->findDoctorScheduleById($id);
            DB::beginTransaction();
                $this->doctorScheduleRepo->updateAvailableWeekScheduleStatus($scheduleDetail);
            DB::commit();
            return true;
        }catch(\Exception $e){
            throw $e;
        }
    }

    public function delete($scheduleDetail)
    {
        try{
            DB::beginTransaction();
                $this->doctorScheduleRepo->delete($scheduleDetail);
            DB::commit();
            return true;
        }catch(\Exception $e){
            throw $e;
        }
    }
}
