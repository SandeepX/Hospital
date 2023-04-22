<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Repositories\DepartmentRepository;
use App\Repositories\HospitalProfileRepository;
use App\Requests\department\DepartmentRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DepartmentController extends Controller
{

    private $view = 'backend.department.';

    private DepartmentRepository $departmentRepo;
    private HospitalProfileRepository $hospitalProfileRepo;

    public function __construct(DepartmentRepository $departmentRepo,
                                HospitalProfileRepository $hospitalProfileRepo
    )
    {
        $this->departmentRepo = $departmentRepo;
        $this->hospitalProfileRepo = $hospitalProfileRepo;
    }

    public function index(Request $request)
    {
        try {
            $departments = $this->departmentRepo->getAllDepartmentDetails();
            return view($this->view . 'index', compact('departments'));
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

    public function store(DepartmentRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['hospital_id'] = AppHelper::getHospitalId();
            DB::beginTransaction();
                $this->departmentRepo->store($validatedData);
            DB::commit();
            return redirect()->back()
                ->with('success', 'New Department Added Successfully');
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
            $select = ['description'];
            $department = $this->departmentRepo->findDepartmentDetailById($id, $select);
            $department->description = strip_tags($department->description);
            return response()->json([
                'data' => $department,
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }


    public function edit($id)
    {
        try {
            $departmentDetails = $this->departmentRepo->findDepartmentDetailById($id);
            return view($this->view.'edit',compact('departmentDetails'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function update(DepartmentRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $departmentDetail = $this->departmentRepo->findDepartmentDetailById($id);
            if (!$departmentDetail) {
                throw new \Exception('Department Detail Not Found', 404);
            }
            DB::beginTransaction();
               $this->departmentRepo->update($departmentDetail, $validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'Department Detail Updated Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();
                $this->departmentRepo->toggleStatus($id);
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
            $departmentDetail = $this->departmentRepo->findDepartmentDetailById($id);
            if (!$departmentDetail) {
                throw new \Exception('Department Record Not Found', 404);
            }
            DB::beginTransaction();
                $this->departmentRepo->delete($departmentDetail);
            DB::commit();
            return redirect()->back()->with('success', 'Department Record Deleted  Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }
    public function departmentPosition()
    {
        try{
            $selectDepartment = ['id','dept_name', 'position'];
            $departments = $this->departmentRepo->getAllDepartment($selectDepartment);
            return view($this->view.'departmentPosition',compact('departments' ));
        }catch(\Exception $ex){
            return redirect()->back()->with('danger', $ex->getMessage());
        }
    }
    public function departmentPositionUpdate(Request $request )
    {
        try {
            $dep_ids = $request->department_id;
            $position = 1;
            foreach ($dep_ids as $value)
            {
                $departmentDetail = $this->departmentRepo->findDepartment($value);
                DB::beginTransaction();
                $departmentDetail->update(['position' => $position++]);

                DB::commit();
            }
            return redirect()->back()->with('success', 'Department Position Updated Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }


}
