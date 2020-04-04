<?php

namespace App\Http\Controllers\Sysadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('sysadmin.dashboard.index');
    }
}
