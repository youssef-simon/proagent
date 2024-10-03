<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules\Password;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin:: paginate(10);
	    return Inertia::render('admin/index',[ 'admins'=>$admins  ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
 
        return Inertia::render('admin/create' );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data	= $request->all(); 
		 $validatedData = $request->validate([
			'email' => 'required|email', // Example validation rules
		    'password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()],
		]);
		$arrData =  [
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'email' => $data['email'],
			'password' => Hash::make($data['password'])
		  ];
		  
		$admin=	Admin::create($arrData);
	 
		return to_route('admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
              $admin=Admin::find($id);
		  return Inertia::render('admin/edit',[ 'admin'=>$admin  ]);
    }

   /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request)
    {
		  $data	= $request->all();
		  $validatedData = $request->validate([
			'email' => 'required|email', // Example validation rules
		]);
		
		$arrData =  [
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'], 
		  ];
	  
		$admin = Admin::find($id); 
		$admin->update($arrData);
		return to_route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
           $admin=Admin::find($id);
			$admin->delete();
			return to_route('admin.index');
    }
}
