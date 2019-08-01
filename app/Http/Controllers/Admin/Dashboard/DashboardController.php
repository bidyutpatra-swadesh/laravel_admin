<?php

namespace App\Http\Controllers\Admin\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','AdminMiddleWare']);
    }
    public function dashboard(){
        return view('admin.dashboard.index');
    }
}
