<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\ContactUsRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactUsController extends Controller
{
    private $view = 'backend.contactus.';

    private ContactUsRepository $contactUsRepo;

    public function __construct(ContactUsRepository $contactUsRepo)
    {
        $this->contactUsRepo = $contactUsRepo;
    }

    public function index(Request $request)
    {
        try {
            $filterParameters = [
                'name' => $request->name ?? null,
                'phone_no' => $request->phone_no ?? null,
                'is_seen' => $request->is_seen ?? null,
            ];
            $with = ['department:id,dept_name'];
            $select = ['contact_us.*'];
            $contactUsDetail = $this->contactUsRepo->getAllContactUsLists($filterParameters,$select, $with);
            return view($this->view . 'index', compact('contactUsDetail','filterParameters'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }


    public function show($id)
    {
        try {
            $select = ['*'];
            $queryDetail = $this->contactUsRepo->findContactUsDetailById($id, $select);
            if ($queryDetail->is_seen == 0) {

               DB::beginTransaction();
               $this->contactUsRepo->updateIsQueryViewed($queryDetail);
               DB::commit();
            }
            return response()->json([
                'data' => $queryDetail,
            ]);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $careerApplicantDetail = $this->contactUsRepo->findContactUsDetailById($id);
            if (!$careerApplicantDetail) {
                throw new Exception('Contact Us Detail Not Found', 404);
            }
            DB::beginTransaction();
            $this->contactUsRepo->delete($careerApplicantDetail);
            DB::commit();
            return redirect()->back()->with('success', 'Contact Us Detail Deleted !');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }
}
