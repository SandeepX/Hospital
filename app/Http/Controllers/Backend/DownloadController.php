<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\DownloadRepository;
use App\Requests\download\DownloadRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class DownloadController extends Controller
{
    private $view = 'backend.download.';

    private DownloadRepository $fileRepo;

    public function __construct(DownloadRepository $fileRepo)
    {
        $this->fileRepo = $fileRepo;
    }

    public function index(Request $request)
    {
        try {
            $files = $this->fileRepo->getAllDownloadableFile();
            return view($this->view . 'index', compact('files'));
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

    public function store(DownloadRequest $request)
    {
        try {
            $validatedData = $request->validated();
            DB::beginTransaction();
            foreach($validatedData['images'] as $key => $value){
                $validatedFile['file'] = $value;
                $validatedFile['title'] = $validatedData['title'];
                $this->fileRepo->store($validatedFile);
            }
            DB::commit();
            return redirect()->back()
                ->with('success', 'New Downloadable File Added Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('danger', $e->getMessage())
                ->withInput();
        }
    }

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();
            $this->fileRepo->toggleStatus($id);
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
            $fileDetail = $this->fileRepo->findDownloadableFileDetailById($id);
            if (!$fileDetail) {
                throw new \Exception('File Not Found', 404);
            }
            DB::beginTransaction();
            $this->fileRepo->delete($fileDetail);
            DB::commit();
            return redirect()->back()->with('success', 'File Deleted  Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }
}
