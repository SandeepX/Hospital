<?php

namespace App\View\Composers;

use App\Models\Department;
use App\Models\HospitalProfile;
use App\Models\Package;
use App\Models\Page;
use Illuminate\View\View;

class HeaderComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $hospitalGeneralDetail = HospitalProfile::select('*')->first();
        $departments = Department::select('id','dept_name')->where('is_active',1)->orderBy('position' , 'asc')->get();
        $packages = Package::select('id','package_name')->where('is_active',1)->get();
        $pages = Page::select('id','name','slug')->get();
        $view->with('hospitalDetail',$hospitalGeneralDetail)
            ->with('departments',$departments)
            ->with('packages',$packages)
            ->with('pages',$pages)
        ;
    }
}
