<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function getIndex(): View
    {
        return view('app.dashboard.index');
    }
}
