<?php

namespace App\Repositories;

use App\Models\ExtraServices;

class ExtraServiceRepository
{
    public function getAllExtraServicesDetail($select = ['*']): mixed
    {
        return ExtraServices::select($select)->orderBy('id','desc')
            ->paginate(ExtraServices::RECORDS_PER_PAGE);
    }

    public function getAllActiveExtraServices($select = ['*'])
    {
        return ExtraServices::select($select)->where('is_active', 1)->get();
    }

    public function store($validatedData): mixed
    {
        return ExtraServices::create($validatedData)->fresh();
    }

    public function toggleStatus($id): mixed
    {
        $hospitalExtraService = $this->findExtraServicesDetailById($id);
        return $hospitalExtraService->update([
            'is_active' => !$hospitalExtraService->is_active,
        ]);
    }


    public function findExtraServicesDetailById($id, $select = ['*']): mixed
    {
        return ExtraServices::select($select)->where('id', $id)->first();
    }

    public function update($hospitalExtraService, $validatedData)
    {

        return $hospitalExtraService->update($validatedData);
    }

    public function delete(ExtraServices $hospitalExtraService)
    {
        return $hospitalExtraService->delete();
    }

}
