<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\doctor\DoctorService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorPositionController extends Controller
{

    private $view = 'backend.doctor.';

    private DoctorService $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    public function index()
    {
        try {
            $select = ['id' , 'full_name' , 'position'];
            $doctors = $this->doctorService->getDoctorListByPosition($select);
            return view($this->view . 'doctorPosition', compact('doctors'));
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function doctorsPositionUpdate(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'doctor_id' => 'required|array|min:1',
                'doctor_id.*' => 'required|numeric'
            ]);
            $this->doctorService->updateDoctorPosition($validatedData);
            return redirect()->back()->with('success', 'Doctor Order Position Updated Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }

}
