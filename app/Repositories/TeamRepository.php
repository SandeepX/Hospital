<?php

namespace App\Repositories;

use App\Models\Team;
use App\Traits\ImageService;
use Illuminate\Support\Facades\DB;

class TeamRepository
{
    use ImageService;

    public function getAllTeamDetails($select = ['*']): mixed
    {
        return Team::select($select)->latest()->get();
    }

    public function getAllActiveTeams($select=['*'])
    {
        return Team::select($select)
            ->where('is_active',1)
            ->orderBy('position','asc')
            ->paginate(Team::RECORDS_PER_PAGE);
    }


    public function store($validatedData): mixed
    {
        $validatedData['image'] = $this->storeImage($validatedData['image'],Team::UPLOAD_PATH,200,200,'team');

        return Team::create($validatedData)->fresh();
    }

    public function toggleStatus($id): mixed
    {
        $teamDetail = $this->findTeamDetailById($id);
        return $teamDetail->update([
            'is_active' => !$teamDetail->is_active,
        ]);
    }

    public function findTeamDetailById($id,$select=['*']): mixed
    {
        return Team::select($select)->where('id', $id)->first();
    }

    public function update($teamDetail, $validatedData)
    {
        if(isset($validatedData['image'])){
            $this->removeImage(Team::UPLOAD_PATH, $teamDetail['image']);
            $validatedData['image'] = $this->storeImage($validatedData['image'],Team::UPLOAD_PATH,200,200,'team');
        }
        return $teamDetail->update($validatedData);
    }

    public function delete(Team $team)
    {
        $this->removeImage(Team::UPLOAD_PATH, $team['image']);
        return $team->delete();
    }

    public function getTeamMemberListByPosition($select)
    {
        return Team::select($select)
            ->orderBy('position' , 'asc')
            ->get();
    }

    public function updateTeamMemberPosition($validatedData)
    {
        $position = 1;
        foreach ($validatedData['teamMemberId'] as $value)
        {
            $teamMember = $this->findTeamDetailById($value);
            $teamMember->update(['position' => $position++]);
        }
        return true;
    }

}
