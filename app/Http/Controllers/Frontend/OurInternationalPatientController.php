<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\InternationalPatientRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OurInternationalPatientController extends Controller
{
    private $view = 'frontend.internationalPatients.';

    private InternationalPatientRepository $internationalPatientRepo;

    public function __construct(InternationalPatientRepository $internationalPatientRepo)
    {
        $this->internationalPatientRepo = $internationalPatientRepo;
    }

    public function getInternationalPatients(): Factory|View|Application|RedirectResponse
    {
        try {
            $internationalPatient = $this->internationalPatientRepo->getAllActiveOurInternationalPatients();
            return view($this->view . 'index', compact('internationalPatient'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function getPatientsDetail($patientId): Factory|View|Application|RedirectResponse
    {
        try {
            $select = ['id','name'];
            $patients =  $this->internationalPatientRepo->getAllActiveOurInternationalPatients($select);
            $patientDetails = $this->internationalPatientRepo->findOurInternationalPatientDetailById($patientId);
            return view($this->view . 'show-detail', compact('patientDetails','patients'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }
}
