<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\StaticPageDetail;
use App\Repositories\PagesRepository;
use App\Repositories\StaticPageDetailRepository;
use App\Requests\contentManagement\staticPageDetail\StaticPageDetailRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaticPageDetailController extends Controller
{
    private $view = 'backend.contentManagement.staticPageDetail.';

    private StaticPageDetailRepository $staticPageDetailRepo;
    private PagesRepository $pagesRepo;

    public function __construct(StaticPageDetailRepository $staticPageDetailRepo,
                                PagesRepository $pagesRepo
    )
    {
        $this->staticPageDetailRepo = $staticPageDetailRepo;
        $this->pagesRepo = $pagesRepo;
    }

    public function index(Request $request)
    {
        try {
            $getAllStaticPageDetail = $this->staticPageDetailRepo->getAllStaticPageDetail();
            return view($this->view . 'index', compact('getAllStaticPageDetail'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function create()
    {
        try {
            $select = ['id','name'];
            $pages = $this->pagesRepo->getAllPages($select);
            return view($this->view.'create',compact('pages'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function store(StaticPageDetailRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['hospital_id'] = AppHelper::getHospitalId();
            DB::beginTransaction();
            $this->staticPageDetailRepo->store($validatedData);
            DB::commit();
            return redirect()->back()
                ->with('success', 'New Static Page Detail Added Successfully');
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
            $select = ['description','title','sub_title','image'];
            $staticPageDetail = $this->staticPageDetailRepo->findStaticPageDetailById($id, $select);
            $staticPageDetail->image = asset(StaticPageDetail::UPLOAD_PATH.$staticPageDetail->image);
            $staticPageDetail->description = strip_tags($staticPageDetail->description);
            return response()->json([
                'data' => $staticPageDetail,
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $select = ['id','name'];
            $pages = $this->pagesRepo->getAllPages($select);
            $staticPageDetail = $this->staticPageDetailRepo->findStaticPageDetailById($id);
            return view($this->view.'edit',compact('staticPageDetail','pages'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function update(StaticPageDetailRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $staticPageDetail = $this->staticPageDetailRepo->findStaticPageDetailById($id);
            if (!$staticPageDetail) {
                throw new \Exception('Static Page Detail Not Found', 404);
            }
            DB::beginTransaction();
                $this->staticPageDetailRepo->update($staticPageDetail, $validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'Static Page Detail Updated Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();
            $this->staticPageDetailRepo->toggleStatus($id);
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
            $staticPageDetail = $this->staticPageDetailRepo->findStaticPageDetailById($id);
            if (!$staticPageDetail) {
                throw new \Exception('Static Page Record Not Found', 404);
            }
            DB::beginTransaction();
            $this->staticPageDetailRepo->delete($staticPageDetail);
            DB::commit();
            return redirect()->back()->with('success', 'Static Page Record Deleted  Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

}
