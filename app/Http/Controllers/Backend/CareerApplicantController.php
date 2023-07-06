<?php

namespace App\Http\Controllers\Backend;


use App\Exports\CareerApplicantsListExport;
use App\Http\Controllers\Controller;
use App\Models\CareerApplicant;
use App\Repositories\CareerApplicantRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CareerApplicantController extends Controller
{
    private $view = 'backend.career.applicant.';

    private CareerApplicantRepository $careerApplicantRepo;

    public function __construct(CareerApplicantRepository $careerApplicantRepo)
    {
        $this->careerApplicantRepo = $careerApplicantRepo;
    }

    public function index(Request $request)
    {
        try {
            $filterParameters = [
                'full_name' => $request->full_name ?? null,
                'email' => $request->email ?? null,
                'contact_no' => $request->contact_no ?? null,
            ];
            $with = ['careerMasterDetail:id,title'];
            $select = ['career_applicants.*'];
            $careerApplicants = $this->careerApplicantRepo->getAllCareerApplicantLists($filterParameters,$select,$with);
            return view($this->view . 'index', compact('careerApplicants','filterParameters'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $select = ['note', 'full_name', 'cv','cover_letter', 'email', 'expected_salary'];
            $detail = $this->careerApplicantRepo->findCareerApplicantsDetailById($id, $select);
            $detail->cv_url = $detail->cv ? asset(CareerApplicant::UPLOAD_PATH.'/'.$detail->cv) : '';
            $detail->cover_letter_url =  $detail->cover_letter ? asset(CareerApplicant::UPLOAD_PATH.'/'.$detail->cover_letter) : '';
            return response()->json([
                'data' => $detail,
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $careerApplicantDetail = $this->careerApplicantRepo->findCareerApplicantsDetailById($id);
            if (!$careerApplicantDetail) {
                throw new Exception('Career Applicant Detail Not Found', 404);
            }
            DB::beginTransaction();
            $this->careerApplicantRepo->delete($careerApplicantDetail);
            DB::commit();
            return redirect()->back()->with('success', 'Career Applicant Detail Deleted !');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function exportApplicantLists()
    {
        try {
            $with = ['careerMasterDetail:id,title'];
            $select = ['career_applicants.*'];
            $careerApplicants = $this->careerApplicantRepo->getAllCareerApplicantListsWithoutPagination($select,$with);
            return \Maatwebsite\Excel\Facades\Excel::download(new CareerApplicantsListExport($careerApplicants), 'career-applicants-lists.xlsx');
        } catch (Exception $exception) {
//      dd($exception->getFile());
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

}
