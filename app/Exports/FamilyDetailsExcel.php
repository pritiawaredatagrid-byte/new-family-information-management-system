<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FamilyDetailsExcel implements FromView, ShouldAutoSize
{
    private $families;

    public function __construct($families)
    {
        $this->families = $families;
    }

    public function view(): View
    {
        return view('Auth.Admin-login.view-family-details-excel', [
            'families' => $this->families,
        ]);
    }
}
