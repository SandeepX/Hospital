<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\PagesRepository;
use App\Requests\contentManagement\page\PageUpdateRequest;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    private $pageView = 'backend.contentManagement.page.';

    private PagesRepository $pagesRepo;

    public function __construct(PagesRepository $pagesRepo)
    {
        $this->pagesRepo = $pagesRepo;
    }

    public function getAllPages()
    {
        try {
            $pages = $this->pagesRepo->getAllPages();
            return view($this->pageView . 'index', compact('pages'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function editPage($id)
    {
        try {
            $pageDetail = $this->pagesRepo->findPageById($id);
            return view($this->pageView . 'edit', compact('pageDetail'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function updatePageDetail(PageUpdateRequest $request,$id)
    {
        try {
            $validatedData = $request->validated();
            $pageDetail = $this->pagesRepo->findPageById($id);
            if (!$pageDetail) {
                throw new \Exception('Page Detail Not Found', 404);
            }
            DB::beginTransaction();
                $this->pagesRepo->update($pageDetail, $validatedData);
            DB::commit();
            return redirect()->route('pages.index')->with('success', 'Page Detail Updated Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }
}
