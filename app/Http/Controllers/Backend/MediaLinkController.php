<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Repositories\MediaLinkRepository;
use App\Requests\contentManagement\mediaLink\MediaLinkRequest;
use App\Requests\contentManagement\mediaLink\MediaLinkStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MediaLinkController extends Controller
{
    private $view = 'backend.contentManagement.mediaLink.';

    private MediaLinkRepository $mediaLinkRepo;

    public function __construct(MediaLinkRepository $mediaLinkRepo)
    {
        $this->mediaLinkRepo = $mediaLinkRepo;
    }

    public function index(Request $request)
    {
        try {
            $mediaLinks = $this->mediaLinkRepo->getAllMediaLink();
            return view($this->view . 'index', compact('mediaLinks'));
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

    public function store(MediaLinkStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            foreach($validatedData['media'] as $key => $value){
                $value['hospital_id'] = AppHelper::getHospitalId();
                DB::beginTransaction();
                    $this->mediaLinkRepo->store($value);
                DB::commit();
            }
            return redirect()->back()
                ->with('success', 'New Media Link Added Successfully')->withInput();
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
            $mediaLinkDetail = $this->mediaLinkRepo->findMediaLinkById($id);
            return view($this->view.'edit',compact('mediaLinkDetail'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function update(MediaLinkRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $mediaLinkDetail = $this->mediaLinkRepo->findMediaLinkById($id);
            if (!$mediaLinkDetail) {
                throw new \Exception('Media Link Detail Not Found', 404);
            }
            DB::beginTransaction();
            $this->mediaLinkRepo->update($mediaLinkDetail, $validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'Media Link Detail Updated Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();
            $this->mediaLinkRepo->toggleStatus($id);
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
            $mediaLinkDetail = $this->mediaLinkRepo->findMediaLinkById($id);
            if (!$mediaLinkDetail) {
                throw new \Exception('Media Link Detail Not Found', 400);
            }
            DB::beginTransaction();
            $this->mediaLinkRepo->delete($mediaLinkDetail);
            DB::commit();
            return redirect()->back()->with('success', 'Media Link Detail Deleted  Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }
}
