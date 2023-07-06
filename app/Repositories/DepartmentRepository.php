<?php

namespace App\Repositories;

use App\Models\Department;
use App\Traits\ImageService;

class DepartmentRepository
{

    use ImageService;
    /**
     * @param $select
     * @return mixed
     */
    public function getAllDepartmentDetails($select = ['*']): mixed
    {
        return Department::select($select)->latest()->get();
    }
    public function getAllDepartment($select = ['*']): mixed
    {
        return Department::select($select)->orderBy('position' , 'asc')->get();
    }

    public function getAllActiveDepartments($select=['*'],$with=[])
    {
        return Department::select($select)->with($with)
            ->where('is_active',1)
            ->get();
    }

    public function getActiveDepartmentsWithDoctors($filterParameters,$select=['*'],$with=[])
    {
        $departmentWithDoctors = Department::select($select)->with($with)
             ->when(isset($filterParameters['name']), function ($query) use ($filterParameters) {
                     $query->where('dept_name', 'like', '%' .$filterParameters['name'] . '%');
            })
        ->where('is_active',1)
            ->orderBy('position' ,'asc')
        ->get();
        return $departmentWithDoctors;
    }

    /**
     * @param $validatedData
     * @return mixed
     */
    public function store($validatedData): mixed
    {
        $validatedData['image'] = $this->storeImage($validatedData['image'],Department::UPLOAD_PATH,200,200,'department');
        $validatedData['png_class'] = $this->storeImage($validatedData['png_class'],Department::UPLOAD_PATH,200,200,'department');

        if($validatedData['dept_opened'] == null){
            $validatedData['dept_opened'] = date('y-m-d');
        }
        return Department::create($validatedData)->fresh();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function toggleStatus($id): mixed
    {
        $departmentDetail = $this->findDepartmentDetailById($id);
        return $departmentDetail->update([
            'is_active' => !$departmentDetail->is_active,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findDepartmentDetailById($id,$select=['*']): mixed
    {
        return Department::select($select)->where('id', $id)->first();
    }

    public function findDepartment($id)
    {
        return Department::find($id);
    }

    public function update($departmentDetail, $validatedData)
    {
        if(isset($validatedData['image'])){
            $this->removeImage(Department::UPLOAD_PATH, $departmentDetail['image']);
            $validatedData['image'] = $this->storeImage($validatedData['image'],Department::UPLOAD_PATH,200,200,'department');
        }
        if(isset($validatedData['png_class'])){
            $this->removeImage(Department::UPLOAD_PATH, $departmentDetail['png_class']);
            $validatedData['png_class'] = $this->storeImage($validatedData['png_class'],Department::UPLOAD_PATH,200,200,'department');
        }
        if($validatedData['dept_opened'] == null){
            $validatedData['dept_opened'] = date('y-m-d');
        }
        return $departmentDetail->update($validatedData);
    }

    public function delete(Department $department)
    {
        $this->removeImage(Department::UPLOAD_PATH, $department['image']);
        $this->removeImage(Department::UPLOAD_PATH, $department['png_class']);
        return $department->delete();
    }

}



