<?php

namespace App\Repositories;

use App\Models\CareerDesignation;

class CareerDesignationRepository
{
    public function getAllCareerDesignation($select=['*'],$with=[])
    {
        return CareerDesignation::select($select)->with($with)->latest()->get();
    }

    public function findCareerDesignationById($id, $select=['*'])
    {
        return CareerDesignation::select($select)->select($select)->where('id',$id)->first();
    }

    public function getAllActiveCareerDesignation($select=['*'],$with=[])
    {
        return CareerDesignation::select($select)->with($with)
            ->where('status',1)
            ->latest()
            ->get();
    }

    public function store($validatedData)
    {
        return CareerDesignation::create($validatedData)->fresh();
    }

    public function update($careerDesignationDetail, $validatedData)
    {
        return $careerDesignationDetail->update($validatedData);
    }

    public function toggleStatus($id)
    {
        $careerDesignationDetail = $this->findCareerDesignationById($id);
        return $careerDesignationDetail->update([
            'status' => !$careerDesignationDetail->status
        ]);
    }

    public function delete(CareerDesignation $careerDesignationDetail)
    {
        return $careerDesignationDetail->delete();
    }
}
