<?php

namespace App\View\Composers;

use App\Models\Department;
use App\Models\HospitalProfile;
use App\Models\HospitalService;
use Illuminate\View\View;

class FooterComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $hospitalDetail = HospitalProfile::select('phone_one','phone_two','logo','description','email','address','name',)->first();
        $departments = Department::select('id', 'dept_name')->where('is_active', 1)->get();
        $services = HospitalService::select('id', 'name')->where('is_active', 1)->where('is_quick_services', 0)->get();

        $view->with('hospitalDetail', $hospitalDetail)
            ->with('departments', $departments)
            ->with('services', $services);
    }
}

