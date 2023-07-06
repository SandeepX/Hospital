<?php

namespace App\Repositories;


use App\Models\Event;
use App\Traits\ImageService;

class EventRepository
{
    use ImageService;
    /**
     * @param $select
     * @return mixed
     */
    public function getAllEventDetails($select = ['*']): mixed
    {
        return Event::select($select)->latest()->paginate(Event::RECORDS_PER_PAGE);
    }

    public function getLatestSixEvents($select = ['*'])
    {
        return Event::select($select)->where('is_active',1)->latest()->take(6)->get();
    }


    /**
     * @param $validatedData
     * @return mixed
     */
    public function store($validatedData): mixed
    {
        $validatedData['image'] = $this->storeImage($validatedData['image'], Event::UPLOAD_PATH, 500, 500, 'event');
        return Event::create($validatedData)->fresh();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function toggleStatus($id): mixed
    {
        $eventDetail = $this->findEventDetailById($id);
        return $eventDetail->update([
            'is_active' => !$eventDetail->is_active,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findEventDetailById($id, $select = ['*']): mixed
    {
        return Event::select($select)->where('id', $id)->first();
    }

    public function update($eventDetail, $validatedData)
    {
        if (isset($validatedData['image'])) {
            $this->removeImage(Event::UPLOAD_PATH, $eventDetail['image']);
            $validatedData['image'] = $this->storeImage($validatedData['image'], Event::UPLOAD_PATH, 500, 500, 'event');
        }
        return $eventDetail->update($validatedData);
    }

    public function delete(Event $event)
    {
        $this->removeImage(Event::UPLOAD_PATH, $event['image']);
        return $event->delete();
    }

}




