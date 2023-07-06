<?php

namespace App\Services\doctor;

use App\Repositories\DoctorRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class DoctorService
{
    private DoctorRepository $doctorRepo;

    public function __construct(DoctorRepository $doctorRepo)
    {
        $this->doctorRepo = $doctorRepo;
    }

    public function getAllDoctorDetail($filterParameters,$select=['*'],$with=[])
    {
        try{
            return $this->doctorRepo->getAllDoctorsDetail($filterParameters,$select,$with);
        }catch (\Exception $exception){
            throw $exception;
        }
    }

    public function getAllActiveDoctorDetail($select=['*'],$with=[])
    {
        try{
            return $this->doctorRepo->getAllActiveDoctors($select,$with);
        }catch (\Exception $exception){
            throw $exception;
        }
    }

    public function findDoctorByDoctorId($id,$select=['*'],$with=[])
    {
        try{
            $doctorDetail =  $this->doctorRepo->findDoctorDetailById($id,$select,$with);
            if(!$doctorDetail){
                throw new Exception('Doctor Detail With Id '.$id. ' Not Found',404);
            }
            return $doctorDetail;
        }catch (\Exception $exception){
            throw $exception;
        }
    }

    public function storeDoctorGeneralDetail($validatedData)
    {
        try{
            DB::beginTransaction();
                $doctorGeneral = $this->doctorRepo->store($validatedData);
            DB::commit();
            return $doctorGeneral;
        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }
    }

    public function updateDoctorGeneralDetail($doctorGeneralDetail,$generalValidatedData)
    {
        try{
            DB::beginTransaction();
                $this->doctorRepo->update($doctorGeneralDetail,$generalValidatedData);
            DB::commit();
            return true;
        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }
    }

    public function createManyAcademicDetailOfDoctor($doctorDetail,$validatedAcademicData): bool
    {
        try{
            $academicDetail = [];
            foreach($validatedAcademicData['academic'] as $key => $value){
                if($value['qualification']){
                    $academicDetail[$key]['qualification'] = $value['qualification'];
                    $academicDetail[$key]['university'] = $value['university'];
                    $academicDetail[$key]['passed_year'] = $value['passed_year'];
                }
            }
            DB::beginTransaction();
                $this->doctorRepo->createManyAcademicDetail($doctorDetail,$academicDetail);
            DB::commit();
            return true;
        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }
    }

    public function createManySkillDetailOfDoctor($doctorDetail,$validatedSkillData): bool
    {
        try{
            $skillDetail = [];
            foreach($validatedSkillData['skill'] as $key => $value){
                if($value['skill_name']){
                    $skillDetail[$key]['skill_name'] = $value['skill_name'];
                    $skillDetail[$key]['expertise_level'] = $value['expertise_level'];
                }
            }
            DB::beginTransaction();
                $this->doctorRepo->createManySkillDetails($doctorDetail,$skillDetail);
            DB::commit();
            return true;
        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }
    }

    public function createManyExperienceDetailOfDoctor($doctorDetail,$validatedExperienceData): bool
    {
        try{
            $experienceDetail = [];
            foreach($validatedExperienceData['experience'] as $key => $value){
                if($value['description']){
                    $experienceDetail[$key]['description'] = $value['description'];
                }
            }
            DB::beginTransaction();
                $this->doctorRepo->createManyWorkExperienceDetails($doctorDetail,$experienceDetail);
            DB::commit();
            return true;
        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }
    }

    public function toggleDoctorIsActiveStatus($id,$select=['*'],$with=[])
    {
        try{
            $doctorDetail =  $this->doctorRepo->findDoctorDetailById($id,$select,$with);
            if(!$doctorDetail){
                throw new Exception('Doctor Detail With Id '.$id. ' Not Found',404);
            }
            DB::beginTransaction();
                $this->doctorRepo->toggleStatus($doctorDetail);
            DB::commit();
             return ;
        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }
    }

    public function deleteDoctorDetail($id,$select=['*'],$with=[])
    {
        try{
            $doctorDetail =  $this->doctorRepo->findDoctorDetailById($id,$select,$with);
            if(!$doctorDetail){
                throw new Exception('Doctor Detail With Id '.$id. ' Not Found',404);
            }
            DB::beginTransaction();
                $this->doctorRepo->delete($doctorDetail);
            DB::commit();
            return ;
        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }
    }

    public function deleteDoctorSecondaryDetail($doctorGeneralDetail)
    {
        try{
            DB::beginTransaction();
                $this->doctorRepo->deleteSecondaryDetail($doctorGeneralDetail);
            DB::commit();
            return true;
        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }
    }

    public function getDoctorListByPosition($select=['*'])
    {
        return $this->doctorRepo->getDoctorListByPosition($select);
    }

    public function updateDoctorPosition($validatedData)
    {
        $doctor_ids = $validatedData['doctor_id'];
        $position = 1;
        foreach ($doctor_ids as $value)
        {
            $_doctor = $this->doctorRepo->findDoctor($value);
            DB::beginTransaction();
                $_doctor->update(['position' => $position++]);
            DB::commit();
        }
        return true;
    }



}
