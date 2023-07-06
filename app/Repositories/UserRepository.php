<?php

namespace App\Repositories;

use App\Helpers\AppHelper;
use App\Models\User;
use App\Traits\ImageService;

class UserRepository
{
    use ImageService;

    public function getAllUsers($filterParameters,$select,$with)
    {
         return User::select($select)->with($with)
             ->when(isset($filterParameters['email']), function ($query) use ($filterParameters) {
                 $query->where('email', 'like', '%' . $filterParameters['email'] . '%');
             })
             ->when(isset($filterParameters['name']), function ($query) use ($filterParameters) {
                 $query->where('name', 'like', '%' . $filterParameters['name'] . '%');
             })

             ->paginate(User::RECORDS_PER_PAGE);
    }

    public function getAllActiveUser($select=['*'],$with=[])
    {
        return User::select($select)->with($with)
            ->where('is_active',1)
            ->simplePaginate(User::RECORDS_PER_PAGE);
    }

    public function findUserDetailById($id, $select = ['*'], $with = [])
    {
        return User::with($with)->select($select)->where('id', $id)->first();
    }

    public function toggleIsActiveStatus($id)
    {
        $userDetail = $this->findUserDetailById($id);
        return $userDetail->update([
            'is_active' => !$userDetail->is_active,
        ]);
    }

    public function store($validatedData)
    {
        $validatedData['created_by'] = AppHelper::getAuthUserId();
        $validatedData['avatar'] = $this->storeImage($validatedData['avatar'], User::AVATAR_UPLOAD_PATH,150,150);
        return User::create($validatedData)->fresh();
    }

    public function update($userDetail, $validatedData)
    {
        if (isset($validatedData['avatar'])) {
            $this->removeImage(User::AVATAR_UPLOAD_PATH, $userDetail['avatar']);
            $validatedData['avatar'] = $this->storeImage($validatedData['avatar'], User::AVATAR_UPLOAD_PATH,150,150);
        }
        $userDetail->update($validatedData);
        return $userDetail;
    }

    public function getUserByUserName($userName, $select = ['*'])
    {
        return User::select($select)->where('username', $userName)->first();
    }

    public function getUserByUserEmail($userEmail, $select = ['*'])
    {
        return User::select($select)->where('email', $userEmail)->first();
    }

    public function delete($userDetail)
    {
        $this->removeImage(User::AVATAR_UPLOAD_PATH, $userDetail['avatar']);
        return $userDetail->delete();
    }

    public function changePassword($userDetail,$newPassword)
    {
        return $userDetail->update([
            'password' => bcrypt($newPassword)
        ]);
    }


}

