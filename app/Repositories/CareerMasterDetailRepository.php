<?php

namespace App\Repositories;

use App\Models\CareerMasterDetail;
use App\Traits\ImageService;

class CareerMasterDetailRepository
{
    use ImageService;
    /**
     * @param $select
     * @return mixed
     */
    public function getAllCareerOpportunitiesDetails($select = ['*']): mixed
    {
        return CareerMasterDetail::select($select)->latest()->paginate(CareerMasterDetail::RECORDS_PER_PAGE);
    }

    public function getAllActiveCareerOpportunitiesDetails($select = ['*'],$with=[])
    {
        return CareerMasterDetail::with($with)->select($select)->where('status', 1)->get();
    }

    /**
     * @param $validatedData
     * @return mixed
     */
    public function store($validatedData): mixed
    {
        $validatedData['image'] = $this->storeImage($validatedData['image'], CareerMasterDetail::UPLOAD_PATH, 500, 500, 'career');
        return CareerMasterDetail::create($validatedData)->fresh();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function toggleStatus($id): mixed
    {
        $careerOpportunitiesDetail = $this->findCareerOpportunitiesDetailById($id);
        return $careerOpportunitiesDetail->update([
            'status' => !$careerOpportunitiesDetail->status,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findCareerOpportunitiesDetailById($id, $select = ['*'],$with=[]): mixed
    {
        return CareerMasterDetail::with($with)->select($select)->where('id', $id)->first();
    }

    public function update($careerOpportunitiesDetail, $validatedData)
    {
        if (isset($validatedData['image'])) {
            $this->removeImage(CareerMasterDetail::UPLOAD_PATH, $careerOpportunitiesDetail['image']);
            $validatedData['image'] = $this->storeImage($validatedData['image'], CareerMasterDetail::UPLOAD_PATH, 500, 500, 'career');
        }
        return $careerOpportunitiesDetail->update($validatedData);
    }

    public function delete(CareerMasterDetail $event)
    {
        $this->removeImage(CareerMasterDetail::UPLOAD_PATH, $event['image']);
        return $event->delete();
    }


}
