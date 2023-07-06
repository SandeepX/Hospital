<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Repositories\BlogRepository;
use App\Requests\contentManagement\blog\BlogRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    private $view = 'backend.contentManagement.blogs.';

    private BlogRepository $blogRepo;


    public function __construct(BlogRepository $blogRepo)
    {
        $this->blogRepo = $blogRepo;
    }

    public function index(Request $request)
    {
        try {
            $blogs = $this->blogRepo->getAllBlogDetail();
            return view($this->view . 'index', compact('blogs'));
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

    public function store(BlogRequest $request)
    {
        try {
            $validatedData = $request->validated();
            DB::beginTransaction();
            $this->blogRepo->store($validatedData);
            DB::commit();
            return redirect()->back()
                ->with('success', 'New Blog Added Successfully');
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
            $select = ['description','title','image'];
            $blog = $this->blogRepo->findBlogById($id, $select);
            $blog->image = asset(Blog::UPLOAD_PATH.$blog->image);
            $blog->description = strip_tags($blog->description);
            return response()->json([
                'data' => $blog,
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $blogDetail = $this->blogRepo->findBlogById($id);
            return view($this->view.'edit',compact('blogDetail'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function update(BlogRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $blogDetail = $this->blogRepo->findBlogById($id);
            if (!$blogDetail) {
                throw new \Exception('Blog Detail Not Found', 404);
            }
            DB::beginTransaction();
            $this->blogRepo->update($blogDetail, $validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'Blog Detail Updated Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();
            $this->blogRepo->toggleStatus($id);
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
            $blogDetail = $this->blogRepo->findBlogById($id);
            if (!$blogDetail) {
                throw new \Exception('Blog Record Not Found', 404);
            }
            DB::beginTransaction();
            $this->blogRepo->delete($blogDetail);
            DB::commit();
            return redirect()->back()->with('success', 'Blog Record Deleted  Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }
}
