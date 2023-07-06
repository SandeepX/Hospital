<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\HospitalServiceRepository;
use App\Repositories\DepartmentRepository;
use App\Requests\hospitalService\HospitalServiceRequest;
use Illuminate\Http\Request;
use App\Helpers\AppHelper;
use Exception;
use Illuminate\Support\Facades\DB;


class HospitalServiceController extends Controller
{

    private $view = 'backend.hospitalService.';

    private HospitalServiceRepository $hospitalServiceRepo;
    private DepartmentRepository      $departmentRepo;


    public function __construct(DepartmentRepository      $departmentRepo,
                                HospitalServiceRepository $hospitalServiceRepo
    )
    {
        $this->departmentRepo = $departmentRepo;
        $this->hospitalServiceRepo = $hospitalServiceRepo;
    }

    public function index(Request $request)
    {
        try {
            $hospitalServices = $this->hospitalServiceRepo->getAllHospitalServiceDetail();
            return view($this->view . 'index', compact('hospitalServices'));
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

    public function store(HospitalServiceRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['hospital_id'] = AppHelper::getHospitalId();
            DB::beginTransaction();
            $this->hospitalServiceRepo->store($validatedData);
            DB::commit();
            return redirect()->back()
                ->with('success', 'New Hospital Service Detail Added Successfully');
        } catch (\Exception $e) {
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
            $select = ['description','name'];
            $hospitalService = $this->hospitalServiceRepo->findHospitalServiceDetailById($id, $select);
            $hospitalService->name = ucfirst($hospitalService->name);
            $hospitalService->description = strip_tags($hospitalService->description);
            return response()->json([
                'data' => $hospitalService,
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }


    public function edit($id)
    {
        try {
            $hospitalServiceDetail = $this->hospitalServiceRepo->findHospitalServiceDetailById($id);
//            dd($hospitalServiceDetail);
            return view($this->view . 'edit', compact('hospitalServiceDetail'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function update(HospitalServiceRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $hospitalTopService = $this->hospitalServiceRepo->findHospitalServiceDetailById($id);
            if (!$hospitalTopService) {
                throw new \Exception('Hospital Service Detail Not Found', 404);
            }
            DB::beginTransaction();
            $this->hospitalServiceRepo->update($hospitalTopService, $validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'Hospital Service Detail Updated Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();
            $this->hospitalServiceRepo->toggleStatus($id);
            DB::commit();
            return redirect()->back()->with('success', 'Status changed Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function toggleQuickServicesStatus($id)
    {
        try {
            DB::beginTransaction();
            $this->hospitalServiceRepo->toggleQuickServicesStatus($id);
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
            $hospitalTopService = $this->hospitalServiceRepo->findHospitalServiceDetailById($id);
            if (!$hospitalTopService) {
                throw new \Exception('Hospital Service Detail Not Found', 404);
            }
            DB::beginTransaction();
            $this->hospitalServiceRepo->delete($hospitalTopService);
            DB::commit();
            return redirect()->back()->with('success', 'Hospital Service Detail Deleted  Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

}

