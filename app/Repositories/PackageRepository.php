<?php

namespace App\Repositories;

use App\Models\HospitalService;
use App\Models\Package;
use App\Traits\ImageService;

class PackageRepository
{
    use ImageService;
    /**
     * @param $select
     * @return mixed
     */
    public function getAllPackageDetails($select = ['*']): mixed
    {
        return Package::select($select)->latest()->paginate(Package::RECORDS_PER_PAGE);
    }

    public function getAllActivePackages($select = ['*'])
    {
        return Package::select($select)->where('is_active', 1)->get();
    }

    /**
     * @param $validatedData
     * @return mixed
     */
    public function store($validatedData): mixed
    {
        $validatedData['image'] = $this->storeImage($validatedData['image'], Package::UPLOAD_PATH, 400, 400, 'package');
        $validatedData['package_icon'] = $this->storeImage($validatedData['package_icon'], Package::UPLOAD_PATH, 150, 150, 'package-icon');
        return Package::create($validatedData)->fresh();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function toggleStatus($id): mixed
    {
        $packageDetail = $this->findPackageDetailById($id);
        return $packageDetail->update([
            'is_active' => !$packageDetail->is_active,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findPackageDetailById($id, $select = ['*']): mixed
    {
        return Package::select($select)->where('id', $id)->first();
    }

    public function update($packageDetail, $validatedData)
    {
        if (isset($validatedData['image'])) {
            $this->removeImage(Package::UPLOAD_PATH, $packageDetail['image']);
            $validatedData['image'] = $this->storeImage($validatedData['image'], Package::UPLOAD_PATH, 400, 400, 'package');
        }
        if (isset($validatedData['package_icon'])) {
            $this->removeImage(Package::UPLOAD_PATH, $packageDetail['package_icon']);
            $validatedData['package_icon'] = $this->storeImage($validatedData['package_icon'], Package::UPLOAD_PATH, 150, 150, 'package-icon');
        }
        return $packageDetail->update($validatedData);
    }

    public function delete(Package $package)
    {
        $this->removeImage(Package::UPLOAD_PATH, $package['image']);
        $this->removeImage(Package::UPLOAD_PATH, $package['package_icon']);
        return $package->delete();
    }

}





