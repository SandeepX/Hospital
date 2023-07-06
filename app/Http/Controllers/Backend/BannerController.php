<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Repositories\BannerRepository;
use App\Requests\contentManagement\banner\BannerRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    private $view = 'backend.contentManagement.banner.';

    private BannerRepository $bannerRepo;

    public function __construct(BannerRepository $bannerRepo)
    {
        $this->bannerRepo = $bannerRepo;
    }

    public function index(Request $request)
    {
        try {
            $banners = $this->bannerRepo->getAllBanner();
            return view($this->view . 'index', compact('banners'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function create()
    {
        try {
            return view($this->view . 'create');
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function store(BannerRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['hospital_id'] = AppHelper::getHospitalId();
            DB::beginTransaction();
            $this->bannerRepo->store($validatedData);
            DB::commit();
            return redirect()->back()
                ->with('success', 'New Banner Added Successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('danger', $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $bannerDetail = $this->bannerRepo->findBannerById($id);
            return view($this->view . 'edit', compact('bannerDetail'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function update(BannerRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $bannerDetail = $this->bannerRepo->findBannerById($id);
            if (!$bannerDetail) {
                throw new Exception('Banner Detail Not Found', 404);
            }
            DB::beginTransaction();
            $this->bannerRepo->update($bannerDetail, $validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'Banner Detail Updated Successfully');
        } catch (Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();
            $this->bannerRepo->toggleStatus($id);
            DB::commit();
            return redirect()->back()->with('success', 'Status changed  Successfully');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $bannerDetail = $this->bannerRepo->findBannerById($id);
            if (!$bannerDetail) {
                throw new Exception('Banner Detail Not Found', 400);
            }
            DB::beginTransaction();
            $this->bannerRepo->delete($bannerDetail);
            DB::commit();
            return redirect()->back()->with('success', 'Banner Detail Deleted  Successfully');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }
}
