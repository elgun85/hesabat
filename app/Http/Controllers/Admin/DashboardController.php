<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminDashboard;


class DashboardController extends Controller
{

    public function index()
    {

       return view('back.dashboard');
    }

    public function profile()
    {
        return view('profile.show');
    }
}
