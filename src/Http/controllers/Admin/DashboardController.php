<?php

namespace Paparadi\Papaadmin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        return view('Papaadmin::admin.common.dashboard');
    }
}
