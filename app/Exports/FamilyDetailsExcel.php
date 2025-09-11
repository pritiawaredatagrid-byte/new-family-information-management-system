<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView; 
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FamilyDetailsExcel implements FromView,ShouldAutoSize
{

    private $head;

    public function __construct($head)
    {
        $this->head = $head;
    }

    public function view(): View
    {
        return view('Auth.Admin-login.view-family-details-excel', [
            'head' => $this->head,
        ]);
    }
}