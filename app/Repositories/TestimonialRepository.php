<?php

namespace App\Repositories;

use App\Models\Testimonial;
use App\Traits\ImageService;

class TestimonialRepository
{
    use ImageService;
    /**
     * @param $select
     * @return mixed
     */
    public function getAllTestimonialDetails($filterParameters,$select = ['*'],$with=[]): mixed
    {
        return Testimonial::select($select)
            ->when(isset($filterParameters['name']), function ($query) use ($filterParameters) {
                $query->where('name', 'like', '%' . $filterParameters['name'] . '%');
            })
            ->when(isset($filterParameters['is_published']), function ($query) use ($filterParameters) {
                $query->where('is_published', $filterParameters['is_published']);
            })
            ->latest()
            ->paginate(Testimonial::RECORDS_PER_PAGE);
    }

    public function getAllPublishedTestimonials($select = ['*'])
    {
        return Testimonial::select($select)->where('is_published', 1)->get();
    }

    /**
     * @param $validatedData
     * @return mixed
     */
    public function store($validatedData): mixed
    {
        $validatedData['image'] = $this->storeImage($validatedData['image'], Testimonial::UPLOAD_PATH, 250, 250, 'testimonial');
        return Testimonial::create($validatedData)->fresh();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function toggleStatus($id): mixed
    {
        $testimonialDetail = $this->findTestimonialDetailById($id);
        return $testimonialDetail->update([
            'is_published' => !$testimonialDetail->is_published,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findTestimonialDetailById($id, $select = ['*']): mixed
    {
        return Testimonial::select($select)->where('id', $id)->first();
    }

    public function update($testimonialDetail, $validatedData)
    {
        if (isset($validatedData['image'])) {
            $this->removeImage(Testimonial::UPLOAD_PATH, $testimonialDetail['image']);
            $validatedData['image'] = $this->storeImage($validatedData['image'], Testimonial::UPLOAD_PATH, 250, 250, 'testimonial');
        }
        return $testimonialDetail->update($validatedData);
    }

    public function delete(Testimonial $event)
    {
        $this->removeImage(Testimonial::UPLOAD_PATH, $event['image']);
        return $event->delete();
    }


}
