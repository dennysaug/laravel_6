<?php

namespace App\Http\Controllers\Sysadmin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('sysadmin.dashboard.index2');
    }

    public function cooking()
    {
        return view('sysadmin.dashboard.cooking');
    }
}
