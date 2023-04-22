<?php

namespace App\Repositories;

use App\Models\CareerApplicant;
use App\Traits\ImageService;

class CareerApplicantRepository
{
    use ImageService;

    public function getAllCareerApplicantLists($filterParameters,$select = ['*'],$with=[]): mixed
    {
        return CareerApplicant::select($select)->with($with)
            ->when(isset($filterParameters['full_name']), function ($query) use ($filterParameters) {
                $query->where('full_name', 'like', '%' . $filterParameters['full_name'] . '%');
            })
            ->when(isset($filterParameters['email']), function ($query) use ($filterParameters) {
                $query->where('email', 'like', '%' . $filterParameters['email'] . '%');
            })
            ->when(isset($filterParameters['contact_no']), function ($query) use ($filterParameters) {
                $query->where('contact_no', $filterParameters['contact_no']);
            })
            ->latest()
            ->paginate(CareerApplicant::RECORDS_PER_PAGE);
    }

    public function store($validatedData): mixed
    {
        $validatedData['cv'] = $this->storeImage($validatedData['cv'], CareerApplicant::UPLOAD_PATH, 500, 500, 'applicants');
        $validatedData['cover_letter'] = $this->storeImage($validatedData['cover_letter'], CareerApplicant::UPLOAD_PATH, 500, 500, 'applicants');
        return CareerApplicant::create($validatedData)->fresh();
    }

    public function findCareerApplicantsDetailById($id, $select = ['*'],$with=[]): mixed
    {
        return CareerApplicant::select($select)->with($with)->where('id', $id)->first();
    }

    public function delete(CareerApplicant $careerApplicant)
    {
        $this->removeImage(CareerApplicant::UPLOAD_PATH, $careerApplicant['cv']);
        return $careerApplicant->delete();
    }

}
