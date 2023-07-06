<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\BlogRepository;
use App\Repositories\PagesRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BlogController extends Controller
{
    private $view = 'frontend.blogs.';

    private PagesRepository $pagesRepo;
    private BlogRepository $blogRepo;

    public function __construct(PagesRepository $pagesRepo, BlogRepository $blogRepo)
    {
        $this->pagesRepo = $pagesRepo;
        $this->blogRepo = $blogRepo;
    }

    public function index(): Factory|View|Application|RedirectResponse
    {
        try {
            $slug = 'blogs';
            $select= ['id','title','sub_title','tags','image','created_date','short_description'];
            $blogs = $this->blogRepo->getAllActiveBlogs($select);
            $pageDetail = $this->pagesRepo->findPageDetailBYPageSlug($slug);
            return view($this->view . 'blog-list', compact('blogs', 'pageDetail'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function getBlogDetailById($blogId): Factory|View|Application|RedirectResponse
    {
        try{
            $select = ['id','title','image','created_date','created_by'];
            $with = ['createdBy:id,name'];
            $blogs =  $this->blogRepo->getLatestPublishedBlogs($select,$with);
            $blogDetail =  $this->blogRepo->findBlogById($blogId,['*'],$with);
            $url = route('front.blog-details',$blogId);
            $socialShare =  \Share::page( $url,$blogDetail->title)
                ->facebook()
                ->twitter()
                ->reddit()
                ->linkedin()
                ->telegram();
            return view($this->view .'blog-detail',compact('socialShare','blogDetail','blogs'));
        }catch(\Exception $exception){
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

}
