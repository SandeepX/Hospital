<?php

namespace App\Repositories;

use App\Models\OurInternationalPatient;
use App\Traits\ImageService;

class InternationalPatientRepository
{
    use ImageService;

    public function getAllInternationalPatientDetail($select = ['*']): mixed
    {
        return OurInternationalPatient::select($select)->orderBy('id', 'desc')->get();
    }

    public function getAllActiveOurInternationalPatients($select = ['*'])
    {
        return OurInternationalPatient::select($select)->where('is_active', 1)->get();
    }

    public function store($validatedData): mixed
    {
        $validatedData['image'] = $this->storeImage($validatedData['image'], OurInternationalPatient::UPLOAD_PATH, 200, 200, 'international-patient');
        return OurInternationalPatient::create($validatedData)->fresh();
    }


    public function toggleStatus($id): mixed
    {
        $internationalPatientDetail = $this->findOurInternationalPatientDetailById($id);
        return $internationalPatientDetail->update([
            'is_active' => !$internationalPatientDetail->is_active,
        ]);
    }

    public function findOurInternationalPatientDetailById($id, $select = ['*']): mixed
    {
        return OurInternationalPatient::select($select)->where('id', $id)->first();
    }

    public function update($internationalPatientDetail, $validatedData)
    {
        if (isset($validatedData['image'])) {
            $this->removeImage(OurInternationalPatient::UPLOAD_PATH, $internationalPatientDetail['image']);
            $validatedData['image'] = $this->storeImage($validatedData['image'], OurInternationalPatient::UPLOAD_PATH, 200, 200, 'international-patient');
        }
        return $internationalPatientDetail->update($validatedData);
    }

    public function delete(OurInternationalPatient $internationalPatient)
    {
        $this->removeImage(OurInternationalPatient::UPLOAD_PATH, $internationalPatient['image']);
        return $internationalPatient->delete();
    }

}





