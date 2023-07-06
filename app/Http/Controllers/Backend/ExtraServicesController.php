<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Repositories\ExtraServiceRepository;
use App\Requests\hospitalService\HospitalExtraServiceEditRequest;
use App\Requests\hospitalService\HospitalExtraServiceStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExtraServicesController extends Controller
{
    private $view = 'backend.hospitalService.extraService.';

    private ExtraServiceRepository $extraServiceRepo;


    public function __construct(ExtraServiceRepository $extraServiceRepo)
    {
        $this->extraServiceRepo = $extraServiceRepo;
    }

    public function index(Request $request)
    {
        try {
            $hospitalExtraServices = $this->extraServiceRepo->getAllExtraServicesDetail();
            return view($this->view . 'index', compact('hospitalExtraServices'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function create()
    {
        try {
            return view($this->view . 'create');
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function store(HospitalExtraServiceStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            foreach($validatedData['extraService'] as $key => $value){
                DB::beginTransaction();
                    $this->extraServiceRepo->store($value);
                DB::commit();
            }
            return redirect()->back()
                ->with('success', 'Additional Hospital Services Added Successfully')
                ->withInput();
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
            $extraServiceDetail = $this->extraServiceRepo->findExtraServicesDetailById($id);
            return view($this->view . 'edit', compact('extraServiceDetail'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function update(HospitalExtraServiceEditRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $extraService = $this->extraServiceRepo->findExtraServicesDetailById($id);
            if (!$extraService) {
                throw new \Exception('Detail Not Found', 404);
            }
            DB::beginTransaction();
                $this->extraServiceRepo->update($extraService, $validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'Hospital Service Updated Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();
                $this->extraServiceRepo->toggleStatus($id);
            DB::commit();
            return redirect()->back()->with('success', 'Status changed Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $extraServiceDetail = $this->extraServiceRepo->findExtraServicesDetailById($id);
            if (!$extraServiceDetail) {
                throw new \Exception('Service Detail Not Found', 404);
            }
            DB::beginTransaction();
            $this->extraServiceRepo->delete($extraServiceDetail);
            DB::commit();
            return redirect()->back()->with('success', 'Service Deleted  Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

}
