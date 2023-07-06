<?php

namespace App\Repositories;

use App\Models\ContactUs;

class ContactUsRepository
{
    public function getAllContactUsLists($filterParameters,$select = ['*'],$with=[]): mixed
    {
        return ContactUs::select($select)->with($with)
            ->when(isset($filterParameters['name']), function ($query) use ($filterParameters) {
                $query->where('name', 'like', '%' . $filterParameters['name'] . '%');
            })
            ->when(isset($filterParameters['phone_no']), function ($query) use ($filterParameters) {
                $query->where('phone_no',  $filterParameters['phone_no'] );
            })
            ->when(isset($filterParameters['is_seen']), function ($query) use ($filterParameters) {
                $query->where('is_seen', $filterParameters['is_seen']);
            })
            ->latest()
            ->paginate(ContactUs::RECORDS_PER_PAGE);
    }

    public function store($validatedData): mixed
    {
        return ContactUs::create($validatedData)->fresh();
    }

    public function findContactUsDetailById($id, $select = ['*'],$with=[]): mixed
    {
        return ContactUs::select($select)->with($with)->where('id', $id)->first();
    }

    public function updateIsQueryViewed($queryDetail)
    {
         $queryDetail->update([
            'is_seen' => 1
        ]);
         return $queryDetail;
    }

    public function delete(ContactUs $contactUsDetail)
    {
        return $contactUsDetail->delete();
    }
}
