<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Repositories\CareerApplicantRepository;
use App\Repositories\CareerMasterDetailRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\HospitalProfileRepository;
use App\Repositories\PagesRepository;
use App\Requests\career\careerApplicant\CareerApplicantRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CareerController extends Controller
{
    private CareerMasterDetailRepository $careerMasterDetailRepo;
    private PagesRepository $pagesRepo;
    private CareerApplicantRepository $careerApplicantRepo;

    public function __construct(CareerMasterDetailRepository $careerMasterDetailRepo,PagesRepository $pagesRepo,CareerApplicantRepository $careerApplicantRepo)
    {
        $this->careerMasterDetailRepo = $careerMasterDetailRepo;
        $this->pagesRepo = $pagesRepo;
        $this->careerApplicantRepo = $careerApplicantRepo;
    }

    public function getAllCareerList()
    {
        try{
            $slug = 'careers';
            $selectCareerValue = ['title','address','image','id','career_designation_id'];
            $with = ['designation:id,name'];
            $pageDetail =  $this->pagesRepo->findPageDetailBYPageSlug($slug);
            $careers = $this->careerMasterDetailRepo->getAllActiveCareerOpportunitiesDetails($selectCareerValue,$with);
            return view('frontend.career.career-list',compact('careers',
                    'pageDetail'
                )
            );
        }
        catch(Exception $e){
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    public function getCareerDetailById($careerId)
    {
        try{
            $selectCareerValue = ['title','address','image','id','career_designation_id'];
            $with = ['designation:id,name'];
            $careers = $this->careerMasterDetailRepo->getAllActiveCareerOpportunitiesDetails($selectCareerValue,$with);
            $careerDetail = $this->careerMasterDetailRepo->findCareerOpportunitiesDetailById($careerId,['*'],$with);
            return view('frontend.career.career-detail',compact('careers',
                    'careerDetail'
                )
            );
        }
        catch(Exception $e){
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    public function applicantDetailStore(CareerApplicantRequest $request)
    {
        try {
            $validatedData = $request->validated();
            DB::beginTransaction();
                $this->careerApplicantRepo->store($validatedData);
            DB::commit();
            return AppHelper::sendSuccessResponse('Job Application Submitted Successfully.',[]);
        } catch (Exception $e) {
            DB::rollBack();
            return AppHelper::sendErrorResponse($e->getMessage(), $e->getCode());
        }
    }
}
