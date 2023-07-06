<?php

namespace App\Repositories;

use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Traits\ImageService;

class DoctorRepository
{
    use ImageService;

    public function getAllDoctorsDetail($filterParameters,$select,$with)
    {
        return Doctor::select($select)
            ->with($with)
            ->when(isset($filterParameters['email']), function ($query) use ($filterParameters) {
                $query->where('email', 'like', '%' . $filterParameters['email'] . '%');
            })
            ->when(isset($filterParameters['name']), function ($query) use ($filterParameters) {
                $query->where('full_name', 'like', '%' . $filterParameters['name'] . '%');
            })
            ->when(isset($filterParameters['phone']), function ($query) use ($filterParameters) {
                $query->where('phone_no',$filterParameters['phone']);
            })
            ->when(isset($filterParameters['department']), function ($query) use ($filterParameters) {
                $query->whereHas('department', function ($query) use ($filterParameters) {
                    $query->where('dept_name', 'like', '%' . $filterParameters['department'] . '%');
                });
            })
            ->latest()
            ->paginate(Doctor::RECORDS_PER_PAGE);
    }

    public function findDoctorDetailById($id,$select,$with=[])
    {
        return Doctor::select($select)->with($with)->where('id', $id)->first();
    }


    public function getAllDoctorsByDeptId($deptId,$select=['*'])
    {
        return Doctor::select($select)->where('dept_id', $deptId)->get();
    }

    public function getAllActiveDoctors($select=['*'],$with=[])
    {
        return Doctor::select($select)
            ->with($with)
            ->where('is_active',1)
            ->orderBy('position' ,'asc')
            ->get();
    }

    public function getActiveDoctorsDetail($select=['*'],$with=[])
    {
        return Doctor::select($select)->with($with)
            ->where('is_active',1)
            ->latest()
            ->take(10)
            ->get();

    }

    public function store($validatedData)
    {
        $validatedData['avatar'] = $this->storeImage($validatedData['avatar'], Doctor::UPLOAD_PATH, 500, 500, 'doctor');
        return Doctor::create($validatedData)->fresh();
    }

    public function update($doctorDetail, $validatedData)
    {
        if (isset($validatedData['avatar'])) {
            $this->removeImage(Doctor::UPLOAD_PATH, $doctorDetail['avatar']);
            $validatedData['avatar'] = $this->storeImage($validatedData['avatar'], Doctor::UPLOAD_PATH, 500, 500, 'doctor');
        }
        $doctorDetail->update($validatedData);
        return$validatedData;
    }

    public function toggleStatus($doctorDetail): mixed
    {
        return $doctorDetail->update([
            'is_active' => !$doctorDetail->is_active,
        ]);
    }

    public function delete($doctorDetail)
    {
        $this->removeImage(Doctor::UPLOAD_PATH, $doctorDetail['avatar']);
        return $doctorDetail->delete();
    }

    public function createManyAcademicDetail(Doctor $doctorDetail,$academicDetails)
    {
        return $doctorDetail->academicDetails()->createMany($academicDetails);
    }

    public function createManyScheduleDetails(Doctor $doctorDetail,$scheduleDetails)
    {
        return $doctorDetail->scheduleDetails()->createMany($scheduleDetails);
    }

    public function createManySkillDetails(Doctor $doctorDetail,$skillDetails)
    {
        return $doctorDetail->skillDetails()->createMany($skillDetails);
    }

    public function createManyWorkExperienceDetails(Doctor $doctorDetail,$workExperienceDetails)
    {
        return $doctorDetail->workExperienceDetails()->createMany($workExperienceDetails);
    }

    public function deleteSecondaryDetail($doctorGeneralDetail)
    {
        $doctorGeneralDetail->academicDetails()->delete();
        $doctorGeneralDetail->scheduleDetails()->delete();
        $doctorGeneralDetail->skillDetails()->delete();
        $doctorGeneralDetail->workExperienceDetails()->delete();
        return true;
    }

    public function getDoctorOPDTime($doctorId,$weekDay,$select=['*'],$with=[])
    {
        return DoctorSchedule::select($select)
            ->with($with)
            ->where('doctor_id',$doctorId)
            ->where('available_week_day',$weekDay)
            ->first();
    }

    public function getDoctorAllAvailableWeekDays($doctorId,$select=['*'])
    {
        return DoctorSchedule::select($select)
            ->where('doctor_id',$doctorId)
            ->get();
    }

    public function getDoctorListByPosition($select)
    {
        return Doctor::select($select)
            ->orderBy('position' , 'asc')
            ->get();
    }

    public function findDoctor($doctor_id)
    {
        return Doctor::find($doctor_id);
    }

}
