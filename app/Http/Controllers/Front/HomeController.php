<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Model\Message;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		
		 
		 
	   return Inertia::render('front/home');
    }

     
}
