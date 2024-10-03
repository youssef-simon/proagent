<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AvailableSlot;
use Inertia\Inertia;
use App\Models\Doctor;

class EmpDashboardController extends Controller
{
    
    /**
     * Display the specified resource.
     */
    public function show( )
    {
       
		  return Inertia::render('emp/dashboard' );
    }

 
}
