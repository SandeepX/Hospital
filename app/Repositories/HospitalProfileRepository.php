<?php

namespace App\Repositories;

use App\Models\HospitalProfile;
use App\Traits\ImageService;

class HospitalProfileRepository
{

    use ImageService;

    public function findOrFailHospitalProfileDetailById($id,$select=['*'], $with=[])
    {
        return HospitalProfile::with($with)
            ->select($select)
            ->where('id',$id)
            ->firstOrFail();
    }

    public function getHospitalProfileDetail($select=['*'],$with=[])
    {
        return HospitalProfile::with($with)->select($select)->first();
    }

    public function store($validatedData)
    {
        $validatedData['logo'] = $this->storeImage($validatedData['logo'],HospitalProfile::UPLOAD_PATH,150,150);

        return HospitalProfile::create($validatedData)->fresh();
    }

    public function update($companyDetail, $validatedData)
    {
        if(isset($validatedData['logo'])){
            $this->removeImage(HospitalProfile::UPLOAD_PATH, $companyDetail['logo']);
            $validatedData['logo'] = $this->storeImage($validatedData['logo'],HospitalProfile::UPLOAD_PATH,150,150);
        }
        return $companyDetail->update($validatedData);
    }


}
