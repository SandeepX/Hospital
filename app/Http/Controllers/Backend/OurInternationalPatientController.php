<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\InternationalPatientRepository;
use App\Requests\internationalPatient\InternationalPatientRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class OurInternationalPatientController extends Controller
{

    private $view = 'backend.internationalPatient.';

    private InternationalPatientRepository $internationalPatientRepo;

    public function __construct(InternationalPatientRepository $internationalPatientRepo)
    {
        $this->internationalPatientRepo = $internationalPatientRepo;
    }

    public function index(Request $request)
    {
        try {
            $internationalPatient = $this->internationalPatientRepo->getAllInternationalPatientDetail();
            return view($this->view . 'index',compact('internationalPatient'));
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

    public function store(InternationalPatientRequest $request)
    {
        try{
            $validatedData = $request->validated();
            DB::beginTransaction();
            $this->internationalPatientRepo->store($validatedData);
            DB::commit();
            return redirect()->back()
                ->with('success', 'New International Patient Detail Detail Added Successfully');
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
        try{
            $select = ['description', 'name'];
            $internationalPatient = $this->internationalPatientRepo->findOurInternationalPatientDetailById($id, $select);
            $internationalPatient->name = ucfirst($internationalPatient->name);
            $internationalPatient->description = strip_tags($internationalPatient->description);
            return response()->json([
                'data' => $internationalPatient,
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }


    public function edit($id)
    {
        try {
            $internationalPatientDetail = $this->internationalPatientRepo->findOurInternationalPatientDetailById($id);
            return view($this->view . 'edit', compact('internationalPatientDetail'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function update(InternationalPatientRequest $request, $id)
    {
        try{
            $validatedData = $request->validated();
            $internationalPatient = $this->internationalPatientRepo->findOurInternationalPatientDetailById($id);
            if (!$internationalPatient) {
                throw new \Exception('International Patient Detail Not Found', 404);
            }
            DB::beginTransaction();
            $this->internationalPatientRepo->update($internationalPatient, $validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'International Patient Detail Updated Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();
            $this->internationalPatientRepo->toggleStatus($id);
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
            $internationalPatient = $this->internationalPatientRepo->findOurInternationalPatientDetailById($id);
            if (!$internationalPatient) {
                throw new \Exception('International Patient Detail Not Found', 404);
            }
            DB::beginTransaction();
            $this->internationalPatientRepo->delete($internationalPatient);
            DB::commit();
            return redirect()->back()->with('success', 'International Patient Detail Deleted  Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

}


