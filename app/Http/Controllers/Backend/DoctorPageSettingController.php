<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DoctorPageSetting;
use App\Repositories\DoctorPageSettingRepository;
use App\Requests\settings\doctorPage\doctorPageSettingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorPageSettingController extends Controller
{
    private $view = 'backend.settings.doctor-page.';

    private DoctorPageSettingRepository $doctorPageSettingRepo;

    public function __construct(DoctorPageSettingRepository $doctorPageSettingRepo)
    {
        $this->doctorPageSettingRepo = $doctorPageSettingRepo;
    }

    public function index()
    {
        try{
            $doctorPageSettingDetail = $this->doctorPageSettingRepo->getDoctorPageSettingDetail();
            return view($this->view.'index',compact('doctorPageSettingDetail'));
        }catch(\Exception $exception){
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function store(DoctorPageSettingRequest $request)
    {
        try{
            $validatedData = $request->validated();
            DB::beginTransaction();
                $this->doctorPageSettingRepo->store($validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'Doctor Page Titles Added Successfully');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('danger', $e->getMessage())
                ->withInput();
        }
    }


    public function update(DoctorPageSettingRequest $request, $id)
    {
        try{
            $validatedData = $request->validated();
            $doctorPageSettingDetail = $this->doctorPageSettingRepo->findOrFailDoctorPageSettingDetailById($id);
            if(!$doctorPageSettingDetail){
                throw new \Exception('Doctor Page Title Detail Not Found',204);
            }
            DB::beginTransaction();
            $this->doctorPageSettingRepo->update($doctorPageSettingDetail,$validatedData);
            DB::commit();
            return redirect()->back()
                ->with('success', 'Doctor Page Titles Updated Successfully');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('danger', $e->getMessage())->withInput();
         }
    }

}
