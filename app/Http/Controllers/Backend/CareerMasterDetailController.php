<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CareerMasterDetail;
use App\Repositories\CareerDesignationRepository;
use App\Repositories\CareerMasterDetailRepository;
use App\Requests\career\careerMaster\CareerMasterDetailRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CareerMasterDetailController extends Controller
{
    private $view = 'backend.career.vacancy.';

    private CareerMasterDetailRepository $careerMasterRepo;
    private CareerDesignationRepository $careerDesignationRepo;


    public function __construct(CareerMasterDetailRepository $careerMasterRepo,CareerDesignationRepository $careerDesignationRepo)
    {
        $this->careerMasterRepo = $careerMasterRepo;
        $this->careerDesignationRepo = $careerDesignationRepo;
    }

    public function index(Request $request)
    {
        try {
            $careerOpportunities = $this->careerMasterRepo->getAllCareerOpportunitiesDetails();
            return view($this->view . 'index', compact('careerOpportunities'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function create()
    {
        try {
            $select = ['id','name'];
            $designations = $this->careerDesignationRepo->getAllActiveCareerDesignation($select);
            return view($this->view . 'create',compact('designations'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function store(CareerMasterDetailRequest $request)
    {
        try {
            $validatedData = $request->validated();
            DB::beginTransaction();
                $this->careerMasterRepo->store($validatedData);
            DB::commit();
            return redirect()->back()
                ->with('success', 'New Career Opportunity Added Successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('danger', $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        try {
            $select = ['description', 'title', 'image', 'salary_offered'];
            $detail = $this->careerMasterRepo->findCareerOpportunitiesDetailById($id, $select);
            $detail->image = asset(CareerMasterDetail::UPLOAD_PATH.$detail->image);
            $detail->description = strip_tags( $detail->description);
            return response()->json([
                'data' => $detail,
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $select = ['id','name'];
            $designations = $this->careerDesignationRepo->getAllActiveCareerDesignation($select);
            $careerOpportunityDetail = $this->careerMasterRepo->findCareerOpportunitiesDetailById($id);
            return view($this->view . 'edit', compact('careerOpportunityDetail','designations'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function update(CareerMasterDetailRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $careerOpportunityDetail = $this->careerMasterRepo->findCareerOpportunitiesDetailById($id);
            if (!$careerOpportunityDetail) {
                throw new Exception('Career Opportunity Detail Not Found', 404);
            }
            DB::beginTransaction();
            $this->careerMasterRepo->update($careerOpportunityDetail, $validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'Career Opportunity Detail Updated Successfully');
        } catch (Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();
            $this->careerMasterRepo->toggleStatus($id);
            DB::commit();
            return redirect()->back()->with('success', 'Status changed  Successfully');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $careerOpportunityDetail = $this->careerMasterRepo->findCareerOpportunitiesDetailById($id);
            if (!$careerOpportunityDetail) {
                throw new Exception('Career Opportunity Detail Not Found', 404);
            }
            DB::beginTransaction();
            $this->careerMasterRepo->delete($careerOpportunityDetail);
            DB::commit();
            return redirect()->back()->with('success', 'Career Opportunity Detail Deleted !');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

}
