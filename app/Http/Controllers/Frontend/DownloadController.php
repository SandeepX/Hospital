<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Download;
use App\Repositories\DownloadRepository;
use Exception;
use Illuminate\Http\Request;

class DownloadController
{
    private $view = 'frontend.download';

    private DownloadRepository $fileRepo;

    public function __construct(DownloadRepository $fileRepo)
    {
        $this->fileRepo = $fileRepo;
    }

    public function index(Request $request)
    {
        try {
            $files = $this->fileRepo->getAllActiveDowloadAbleFile();
            return view($this->view, compact('files'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function downloadFile($fileId)
    {
        try{
            $fileDetail = $this->fileRepo->findDownloadableFileDetailById($fileId);
            if(!$fileDetail){
                throw new Exception('File Detail Not found',204);
            }
            $filename = $fileDetail->file;
            $headers = array(
                'Content-Type: application/pdf',
            );
            $pathToFile = public_path(Download::UPLOAD_PATH.$filename);
            return response()->download($pathToFile,$filename,$headers);
        }catch(\Exception $exception){
            return redirect()->back()->with('danger',$exception->getMessage());
        }
    }
}
