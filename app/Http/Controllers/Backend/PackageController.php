<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Repositories\PackageRepository;
use App\Requests\Package\PackageRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    private $view = 'backend.package.';

    private PackageRepository $packageRepo;


    public function __construct(PackageRepository $packageRepo)
    {
        $this->packageRepo = $packageRepo;
    }

    public function index(Request $request)
    {
        try {
            $packages = $this->packageRepo->getAllPackageDetails();
            return view($this->view . 'index', compact('packages'));
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

    public function store(PackageRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['hospital_id'] = AppHelper::getHospitalId();
            DB::beginTransaction();
            $this->packageRepo->store($validatedData);
            DB::commit();
            return redirect()->back()
                ->with('success', 'New Package Added Successfully');
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
            $select = ['description','title','package_name','image'];
            $package = $this->packageRepo->findPackageDetailById($id, $select);
            $package->image = asset(Package::UPLOAD_PATH.$package->image);
            $package->description = strip_tags( $package->description);
            return response()->json([
                'data' => $package,
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }


    public function edit($id)
    {
        try {
            $packageDetail = $this->packageRepo->findPackageDetailById($id);
            return view($this->view.'edit',compact('packageDetail'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function update(PackageRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $packageDetail = $this->packageRepo->findPackageDetailById($id);
            if (!$packageDetail) {
                throw new \Exception('Package Detail Not Found', 404);
            }
            DB::beginTransaction();
            $this->packageRepo->update($packageDetail, $validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'Package Detail Updated Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();
            $this->packageRepo->toggleStatus($id);
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
            $packageDetail = $this->packageRepo->findPackageDetailById($id);
            if (!$packageDetail) {
                throw new \Exception('Package Record Not Found', 404);
            }
            DB::beginTransaction();
            $this->packageRepo->delete($packageDetail);
            DB::commit();
            return redirect()->back()->with('success', 'Package Record Deleted  Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

}
