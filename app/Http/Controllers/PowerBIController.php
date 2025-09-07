<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PowerBIController extends Controller
{
    public function index()
    {
        $powerBIUrl = "https://app.powerbi.com/view?r=YOUR_REPORT_ID";

        return view('admin', compact('powerBIUrl'));
    }
}
//  <div class="container">
//         <iframe title="Power BI Report" src="{{ $powerBIUrl }}" allowFullScreen="true"></iframe>
//       </div>
