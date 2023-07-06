<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CareerApplicantsListExport implements FromView, ShouldAutoSize
{
    protected $careerApplicants;

    function __construct($careerApplicants)
    {
        $this->careerApplicants = $careerApplicants;
    }

    public function view(): View
    {
        return view('backend.career.exports.careerApplicants', [
            'careerApplicants' => $this->careerApplicants
        ]);
    }

}
