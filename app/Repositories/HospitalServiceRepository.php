<?php

namespace App\Repositories;

use App\Models\HospitalService;
use App\Traits\ImageService;

class HospitalServiceRepository
{
    use ImageService;

    /**
     * @param $select
     * @return mixed
     */
    public function getAllHospitalServiceDetail($select = ['*']): mixed
    {
        return HospitalService::select($select)->orderBy('id','desc')->get();
    }

    public function getAllActiveHospitalServices($select = ['*'])
    {
        return HospitalService::select($select)->where('is_active', 1)->where('is_quick_services', 0)->get();
    }

    public function getAllActiveQuickServicesHospitalServices($select = ['*'])
    {
        return HospitalService::select($select)->where('is_active', 1)->where('is_quick_services', 1)->get();
    }

    /**
     * @param $validatedData
     * @return mixed
     */
    public function store($validatedData): mixed
    {
        $validatedData['image'] = $this->storeImage($validatedData['image'], HospitalService::UPLOAD_PATH, 150, 150, 'service');
        $validatedData['png_class'] = $this->storeImage($validatedData['png_class'], HospitalService::UPLOAD_PATH, 150, 150, 'service');
        return HospitalService::create($validatedData)->fresh();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function toggleStatus($id): mixed
    {
        $hospitalServiceDetail = $this->findHospitalServiceDetailById($id);
        return $hospitalServiceDetail->update([
            'is_active' => !$hospitalServiceDetail->is_active,
        ]);
    }
    public function toggleQuickServicesStatus($id): mixed
    {
        $hospitalServiceDetail = $this->findHospitalServiceDetailById($id);
        return $hospitalServiceDetail->update([
            'is_quick_services' => !$hospitalServiceDetail->is_quick_services,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findHospitalServiceDetailById($id, $select = ['*']): mixed
    {
        return HospitalService::select($select)->where('id', $id)->first();
    }

    public function update($hospitalServiceDetail, $validatedData)
    {
        if (isset($validatedData['image'])) {
            $this->removeImage(HospitalService::UPLOAD_PATH, $hospitalServiceDetail['image']);
            $validatedData['image'] = $this->storeImage($validatedData['image'], HospitalService::UPLOAD_PATH, 150, 150, 'service');
        }

        if (isset($validatedData['png_class'])) {
            $this->removeImage(HospitalService::UPLOAD_PATH, $hospitalServiceDetail['png_class']);
            $validatedData['png_class'] = $this->storeImage($validatedData['png_class'], HospitalService::UPLOAD_PATH, 150, 150, 'service');
        }
        return $hospitalServiceDetail->update($validatedData);
    }

    public function delete(HospitalService $hospitalTopService)
    {
        $this->removeImage(HospitalService::UPLOAD_PATH, $hospitalTopService['image']);
        $this->removeImage(HospitalService::UPLOAD_PATH, $hospitalTopService['png_class']);
        return $hospitalTopService->delete();
    }

}




