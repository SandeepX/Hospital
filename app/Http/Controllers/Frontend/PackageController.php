<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\PackageRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PackageController extends Controller
{
    private $view = 'frontend.packages.';

    private PackageRepository $packageRepo;

    public function __construct(PackageRepository $packageRepo)
    {
        $this->packageRepo = $packageRepo;
    }

    public function index(): Factory|View|Application|RedirectResponse
    {
        try {
            $select = ['package_name', 'id', 'package_price','package_icon'];
            $packages = $this->packageRepo->getAllActivePackages($select);
            return view($this->view . 'package-list', compact('packages'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function getPackageDetailById($packageId): Factory|View|Application|RedirectResponse
    {
        try {
            $packagesDetail = $this->packageRepo->findPackageDetailById($packageId);
            return view($this->view . 'package-detail', compact( 'packagesDetail'));
        } catch (Exception $ex) {
            return redirect()->back()->with('danger', $ex->getMessage());
        }
    }
}
