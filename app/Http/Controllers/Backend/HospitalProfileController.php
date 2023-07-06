<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Repositories\HospitalProfileRepository;
use App\Requests\hospital\HospitalProfileRequest;
use Illuminate\Support\Facades\DB;

class HospitalProfileController extends Controller
{
    private $view = 'backend.hospital.';

    private HospitalProfileRepository $hospitalProfileRepo;

    public function __construct(HospitalProfileRepository $hospitalProfileRepo)
    {
        $this->hospitalProfileRepo = $hospitalProfileRepo;
    }

    public function index()
    {
        try{
            $hospitalProfileDetail = $this->hospitalProfileRepo->getHospitalProfileDetail();
            return view($this->view.'index',compact('hospitalProfileDetail'));
        }catch(\Exception $exception){
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function store(HospitalProfileRequest $request)
    {
        try{
            $validatedData = $request->validated();
            DB::beginTransaction();
            $this->hospitalProfileRepo->store($validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'Hospital Profile Detail Added Successfully');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('danger', $e->getMessage())
                ->withInput();
        }
    }


    public function update(HospitalProfileRequest $request, $id)
    {
        try{
            $validatedData = $request->validated();
            $hospitalProfileDetail = $this->hospitalProfileRepo->findOrFailHospitalProfileDetailById($id);
            if(!$hospitalProfileDetail){
                throw new \Exception('Hospital profile Detail Not Found',204);
            }
            DB::beginTransaction();
            $this->hospitalProfileRepo->update($hospitalProfileDetail,$validatedData);
            DB::commit();
            return redirect()->back()
                ->with('success', 'Hospital Detail Detail Updated Successfully');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('danger', $e->getMessage())
                ->withInput();

        }
    }



}
