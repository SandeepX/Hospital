<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CareerDesignation;
use App\Repositories\CareerDesignationRepository;
use App\Requests\career\careerDesignation\CareerDesignationStoreRequest;
use App\Requests\career\careerDesignation\CareerDesignationUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CareerDesignationController extends Controller
{
    private $view = 'backend.career.designation.';

    private CareerDesignationRepository $careerDesignationRepo;

    public function __construct(CareerDesignationRepository $careerDesignationRepo)
    {
        $this->careerDesignationRepo = $careerDesignationRepo;
    }

    public function index(Request $request)
    {
        try {
            $designations = $this->careerDesignationRepo->getAllCareerDesignation();
            return view($this->view . 'index', compact('designations'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function create()
    {
        try {
            return view($this->view.'create');
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function store(CareerDesignationStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            foreach($validatedData['designation'] as $key => $value){
                DB::beginTransaction();
                $this->careerDesignationRepo->store($value);
                DB::commit();
            }
            return redirect()->back()
                ->with('success', 'New Career Designation Added Successfully')->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('danger', $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $careerDesignationDetail = $this->careerDesignationRepo->findCareerDesignationById($id);
            return view($this->view.'edit',compact('careerDesignationDetail'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function update(CareerDesignationUpdateRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $careerDesignationDetail = $this->careerDesignationRepo->findCareerDesignationById($id);
            if (!$careerDesignationDetail) {
                throw new \Exception('Career Designation Detail Not Found', 404);
            }
            DB::beginTransaction();
            $this->careerDesignationRepo->update($careerDesignationDetail, $validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'Career Designation Detail Updated Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();
            $this->careerDesignationRepo->toggleStatus($id);
            DB::commit();
            return redirect()->back()->with('success', 'Status changed  Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $careerDesignationDetail = $this->careerDesignationRepo->findCareerDesignationById($id);
            if (!$careerDesignationDetail) {
                throw new \Exception('Career Designation Detail Not Found', 400);
            }
            DB::beginTransaction();
            $this->careerDesignationRepo->delete($careerDesignationDetail);
            DB::commit();
            return redirect()->back()->with('success', 'Career Designation Detail Deleted  Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }
}
