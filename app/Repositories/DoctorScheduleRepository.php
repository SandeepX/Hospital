<?php

namespace App\Repositories;

use App\Models\DoctorSchedule;

class DoctorScheduleRepository
{


    public function findDoctorScheduleById($id,$select=['*'],$with=[])
    {
        return DoctorSchedule::select($select)->with($with)->where('id',$id)->first();
    }

    public function getAllDoctorScheduleByDoctorId($doctorId)
    {
        return DoctorSchedule::where('doctor_id',$doctorId)->get();
    }

    public function findDoctorScheduleByWeekDay($weekDay,$select=['*'],$with=[])
    {
        return DoctorSchedule::select($select)->with($with)->where('available_week_day',$weekDay)->first();
    }

    public function store($validatedData)
    {
        return DoctorSchedule::create($validatedData)->fresh();
    }

    public function createManyDoctorScheduleTime(DoctorSchedule $scheduleDetail, $timeDetails)
    {
        return $scheduleDetail->doctorTime()->createMany($timeDetails);
    }

    public function updateAvailableWeekScheduleStatus($scheduleDetail)
    {
        return $scheduleDetail->update([
            'is_active' => !$scheduleDetail->is_active
        ]);
    }

    public function delete($scheduleDetail)
    {
        return $scheduleDetail->each->delete();;
    }

    public function update($scheduleWeekDayDetail,$validatedData)
    {
        $scheduleWeekDayDetail->update($validatedData);
        $scheduleWeekDayDetail->doctorTime()->delete();
        return $scheduleWeekDayDetail;
    }





}
