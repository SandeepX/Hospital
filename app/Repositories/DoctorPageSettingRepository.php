<?php

namespace App\Repositories;

use App\Models\DoctorPageSetting;

class DoctorPageSettingRepository
{
    public function findOrFailDoctorPageSettingDetailById($id,$select=['*'], $with=[])
    {
        return DoctorPageSetting::with($with)
            ->select($select)
            ->where('id',$id)
            ->firstOrFail();
    }

    public function getDoctorPageSettingDetail($select=['*'],$with=[])
    {
        return DoctorPageSetting::with($with)->select($select)->first();
    }

    public function store($validatedData)
    {

        return DoctorPageSetting::create($validatedData)->fresh();
    }

    public function update($companyDetail, $validatedData)
    {
       return $companyDetail->update($validatedData);
    }
}
