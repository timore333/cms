<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        switch(auth()->user()->role) {
            case 'super-admin':
                return Inertia::render('Tenants/Dashboards/Admin');
                break;
            case 'doctor':
                return Inertia::render('Tenants/Dashboards/Doctor');
                break;
            case 'reception':
                return Inertia::render('Tenants/Dashboards/Reception');
                break;
            case 'accountant':
                return Inertia::render('Tenants/Dashboards/Accountant');
                break;
            default:
                // for now .
                return 'user not identfied';
        }
    }


}
