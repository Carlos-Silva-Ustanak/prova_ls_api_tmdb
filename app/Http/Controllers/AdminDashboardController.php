<?php

/// app/Http/Controllers/AdminDashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Implement your logic here to fetch data or perform actions for admin dashboard
        return view('admin.dashboard');
    }
}
