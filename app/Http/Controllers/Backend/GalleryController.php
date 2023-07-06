<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\GalleryRepository;
use App\Requests\gallery\GalleryRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    private $view = 'backend.gallery.';

    private GalleryRepository $galleryRepo;

    public function __construct(GalleryRepository $galleryRepo)
    {
        $this->galleryRepo = $galleryRepo;
    }

    public function index(Request $request)
    {
        try {
            $galleries = $this->galleryRepo->getAllGalleryDetail();
            return view($this->view . 'index', compact('galleries'));
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

    public function store(GalleryRequest $request)
    {
        try {
            $galleryValidatedData = $request->validated();
            DB::beginTransaction();
                $this->galleryRepo->store($galleryValidatedData);
            DB::commit();
            return redirect()->back()
                ->with('success', 'New Gallery Added Successfully');
        } catch (\Exception $e) {
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
            $galleryDetail = $this->galleryRepo->findGalleryDetailById($id);
            return view($this->view . 'edit', compact('galleryDetail'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function update(GalleryRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $galleryDetail = $this->galleryRepo->findGalleryDetailById($id);
            if (!$galleryDetail) {
                throw new Exception('Gallery  Detail Not Found', 404);
            }
            DB::beginTransaction();
            $this->galleryRepo->update($galleryDetail, $validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'Gallery  Detail Updated Successfully');
        } catch (Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }



    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();
            $this->galleryRepo->toggleStatus($id);
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
            $galleryDetail = $this->galleryRepo->findGalleryDetailById($id);
            if (!$galleryDetail) {
                throw new \Exception('Gallery Not Found', 404);
            }
            DB::beginTransaction();
                $this->galleryRepo->delete($galleryDetail);
            DB::commit();
            return redirect()->back()->with('success', 'Gallery Deleted  Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }
}
