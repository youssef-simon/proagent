<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\IndexController; 
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController; 
use App\Http\Controllers\CategoriesController; 
use App\Http\Controllers\ProductController; 
use App\Http\Controllers\AttributeController; 

use App\Http\Controllers\AttributeValueController; 
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\ProductPackController; 
use App\Http\Controllers\OrderController; 
use App\Http\Controllers\VerifiedController; 
  
use App\Http\Controllers\SubProductController; 
use App\Http\Controllers\DepartmentController; 
use App\Http\Controllers\TaskController; 
use App\Http\Controllers\EmpDashboardController; 
use App\Http\Controllers\ServiceController; 
use App\Http\Controllers\ServiceCategoryController; 
use App\Http\Controllers\UserProjectController; 
use App\Http\Controllers\Front\HomeController; 
use App\Http\Controllers\Front\AuthController; 
use App\Http\Controllers\Front\MyPurchasesController; 
use App\Http\Controllers\Front\MyProjectController; 
use App\Http\Controllers\Front\MessageController ; 
use App\Http\Controllers\Front\VerificationController as  VerifyFrontController; 
use App\Http\Controllers\Front\UserController as UserFrontController; 
use App\Http\Controllers\Front\ServiceController as ServiceFrontController; 
use App\Http\Controllers\Front\SubscriptionController as SubscriptionFrontController; 
use App\Http\Controllers\Front\ServiceRequestController as ServiceRequestFrontController; 
 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
 return redirect('/admin');
});
 */
Route::get('/', [HomeController::class, 'index'])->name('page');

 
 
Route::post('/admin',[LoginController::class,'adminLogin'])->name('admin.login');
Route::get('/home',[HomeController::class,'index'])->name('home.index');
Route::get('/service',[ServiceFrontController::class,'index'])->name('home.service');
Route::get('/service_view/{id}',[ServiceFrontController::class,'serviceView'])->name('home.service_view');
Route::get('/taxservice',[ServiceFrontController::class,'taxservice'])->name('home.taxservice');
Route::get('/users',[UserFrontController::class,'index'])->name('home.users');
Route::get('/user_details/{id}',[UserFrontController::class,'details'])->name('home.user_details');
Route::get('/user_services/{id}',[UserFrontController::class,'user_services'])->name('home.user_services');
Route::get('/user_works/{id}',[UserFrontController::class,'user_works'])->name('home.user_works');
Route::get('/work_view/{id}',[UserFrontController::class,'work_view'])->name('home.work_view');

Route::get('/register',[AuthController::class,'register'])->name('register.create');
Route::post('/register_store',[AuthController::class,'registerStore'])->name('register.store');

Route::get('/user_login',[AuthController::class,'login'])->name('home.login');
Route::post('/user_login',[AuthController::class,'login_check'])->name('login_check.login');

//Route::get('/service_all/{id}',[ServiceFrontController::class,'serviceAll'])->name('service_all');
Route::get('/service_all/{id}/{childid?}',[ServiceFrontController::class,'serviceAll'])->name('service_all');
Route::get('/service_by_category/{depId}/{id}',[ServiceFrontController::class,'serviceByCategory'])->name('service_by_category');
	

Route::group(['middleware' => ['auth:web']], function () {
	
    	Route::get('/edit_profile',[UserFrontController::class,'edit_profile'])->name('edit_profile');
    	Route::post('/update_profile',[UserFrontController::class,'update_profile'])->name('update_profile');
		
    	Route::get('/my_profile',[UserFrontController::class,'my_profile'])->name('my_profile');
    	Route::get('/my_dashboard',[UserFrontController::class,'my_dashboard'])->name('my_dashboard');
    	Route::get('/my_messages',[MessageController::class,'my_messages'])->name('my_messages');
		
		
		Route::post('/makerequest',[ServiceRequestFrontController::class,'makeRequest'])->name('makerequest');
		Route::get('/create_service',[ServiceFrontController::class,'create_service'])->name('create_service');
		Route::post('/add_service',[ServiceFrontController::class,'add_service'])->name('add_service');
		
		Route::get('/service_list',[ServiceFrontController::class,'service_list'])->name('service_list');
		Route::get('/service_category/{$id}',[ServiceFrontController::class,'service_list_category'])->name('service_list_category');
	
		Route::get('/service_edit/{id}',[ServiceFrontController::class,'service_edit'])->name('service_edit');
		Route::post('/service_update/{id}',[ServiceFrontController::class,'service_update'])->name('service_update');
		
		Route::delete('service/delete/{id}', [ServiceFrontController::class, 'destroy'])->name('service_front.delete');
		
		Route::get('/request_view/{id}',[ServiceRequestFrontController::class,'request_view'])->name('request_view');
		Route::get('/chat_room/{id}', [ServiceRequestFrontController::class, 'chatRoomMessages']);
		Route::post('/post_room_message', [ServiceRequestFrontController::class, 'sendRoomMsg']);
		
		
		
		Route::get('/my_purchases',[MyPurchasesController::class,'index'])->name('my_purchases');
		Route::get('/my_requested_service',[ServiceRequestFrontController::class,'index'])->name('my_requested_service');
		
	 	Route::get('/message_thread/{id}', [\App\Http\Controllers\Front\MessageController::class, 'message_thread']);
		
		Route::get('/message_thread_view/{id}', [\App\Http\Controllers\Front\MessageController::class, 'message_thread_view']);
		
		Route::get('/message_threads_list', [\App\Http\Controllers\Front\MessageController::class, 'message_threads_list']);
		
		
			
		Route::post('/post_message', [\App\Http\Controllers\Front\MessageController::class, 'post_message']);
		Route::post('/remove_message', [\App\Http\Controllers\Front\MessageController::class, 'remove_message']);
		
		Route::post('changetoinprogress', [ServiceRequestFrontController::class, 'changeToInProgress'])->name('changetoinprogress');
		Route::post('changetodelivered', [ServiceRequestFrontController::class, 'changeToDelivered'])->name('changetodelivered');
		
		
		Route::get('/my_works',[MyProjectController::class,'index'])->name('my_works');
		Route::get('/create_work',[MyProjectController::class,'create'])->name('create_work');
		Route::post('/store_work',[MyProjectController::class,'store'])->name('store_work');
		Route::get('/edit_work/{id}',[MyProjectController::class,'edit'])->name('edit_work');
		Route::post('/update_work/{id}',[MyProjectController::class,'update'])->name('update_work');
		 
		Route::delete('delete_work/{id}', [MyProjectController::class, 'destroy'])->name('delete_work_front');
		
		
		Route::get('/verify_create',[VerifyFrontController::class,'verify_create'])->name('verify_create');
		Route::post('/verify_store',[VerifyFrontController::class,'verify_store'])->name('verify_store');
		 
});


Route::get('changedepart/{id}', [UserController::class, 'changeDepart'])->name('get.changeDepart');
Route::get('changecategory/{id}', [UserController::class, 'changeCategory'])->name('get.changeCategory');

Route::get('changecategory/{id}', [UserController::class, 'changeCategory'])->name('get.changeCategory');

Route::get('subscriptions', [SubscriptionFrontController::class, 'index'])->name('subscriptions.index');
Route::post('make_subscr', [SubscriptionFrontController::class, 'make_subscr'])->name('subscriptions.make_subscr');


Route::get('/admin/dashboard',[DashboardController::class,'show'])->name('admin.show');
 
 
 Route::group(['middleware' => ['auth:admin']], function () {
	 		Route::get('/admin',[DashboardController::class,'show'])->name('admin.login-view');
 });

	    Route::group(['prefix'=>'admin','middleware' => ['auth:admin']], function () {
		//Route::get('/admin',[DashboardController::class,'show'])->name('admin.login-view');
  
		Route::get('admin/create', [AdminController::class, 'create'])->name('admin.create');
		Route::post('admin/store', [AdminController::class, 'store'])->name('admin.store');
		Route::get('admin/index', [AdminController::class, 'index'])->name('admin.index');
		Route::delete('admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
		Route::get('admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
		Route::post('admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
		  
		Route::get('user/create', [UserController::class, 'create'])->name('user.create');
		Route::post('user/store', [UserController::class, 'store'])->name('user.store');
		Route::get('user/index', [UserController::class, 'index'])->name('user.index');
		Route::delete('user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
		Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
		Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');  
		  
		  
		 Route::get('department/create', [DepartmentController::class, 'create'])->name('department.create');
		Route::post('department/store', [DepartmentController::class, 'store'])->name('department.store');
		Route::get('department/index', [DepartmentController::class, 'index'])->name('department.index');
		Route::delete('department/delete/{id}', [DepartmentController::class, 'destroy'])->name('department.delete');
		Route::get('department/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
		Route::post('department/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
		
		 		 
		Route::get('task/create', [TaskController::class, 'create'])->name('task.create');
		Route::post('task/store', [TaskController::class, 'store'])->name('task.store');
		Route::get('task/index', [TaskController::class, 'index'])->name('task.index');
		Route::delete('task/delete/{id}', [TaskController::class, 'destroy'])->name('task.delete');
		Route::get('task/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
		Route::post('task/update/{id}', [TaskController::class, 'update'])->name('task.update');
		  
		Route::get('userproject/create/{id}', [UserProjectController::class, 'create'])->name('userproject.create');
		Route::post('userproject/store/{id}', [UserProjectController::class, 'store'])->name('userproject.store');
		Route::get('userproject/index/{id}', [UserProjectController::class, 'index'])->name('userproject.index');
		Route::delete('userproject/delete/{id}', [UserProjectController::class, 'destroy'])->name('userproject.delete');
		Route::get('userproject/edit/{id}', [UserProjectController::class, 'edit'])->name('userproject.edit');
		Route::post('userproject/update/{id}', [UserProjectController::class, 'update'])->name('userproject.update');
		
			Route::get('userproject/view/{id}', [UserProjectController::class, 'view'])->name('userproject.view');
			Route::post('userproject/change_status',[UserProjectController::class,'change_status'])->name('userproject_change_status');
			
			
		Route::get('service/create', [ServiceController::class, 'create'])->name('service.create');
		Route::post('service/store', [ServiceController::class, 'store'])->name('service.store');
		Route::get('service/index', [ServiceController::class, 'index'])->name('service.index');
		Route::delete('service/delete/{id}', [ServiceController::class, 'destroy'])->name('service.delete');
		Route::get('service/edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
		Route::get('service/view/{id}', [ServiceController::class, 'view'])->name('service.view');
		Route::post('service/update/{id}', [ServiceController::class, 'update'])->name('service.update');
		Route::post('/change_status',[ServiceController::class,'change_status'])->name('change_status');
		
		
		Route::get('service_category/create', [ServiceCategoryController::class, 'create'])->name('service_category.create');
		Route::post('service_category/store', [ServiceCategoryController::class, 'store'])->name('service_category.store');
		Route::get('service_category/index', [ServiceCategoryController::class, 'index'])->name('service_category.index');
		Route::delete('service_category/delete/{id}', [ServiceCategoryController::class, 'destroy'])->name('service_category.delete');
		Route::get('service_category/edit/{id}', [ServiceCategoryController::class, 'edit'])->name('service_category.edit');
		Route::post('service_category/update/{id}', [ServiceCategoryController::class, 'update'])->name('service_category.update');
		 
		Route::get('searchusers', [UserController::class, 'searchByName'])->name('searchusers.search');
		Route::get('getuser/{id}', [UserController::class, 'getUserdata'])->name('get.user');
		
		

				Route::get('verified_users', [VerifiedController::class, 'index'])->name('get.verified_users');
		Route::get('verify_user_view/{id}', [VerifiedController::class, 'view'])->name('get.verified_view');
		Route::post('update_status', [VerifiedController::class, 'update_status'])->name('update_status');
			
			 
		 	  
});
 
 
 

	Route::get('/logout_user',[LoginController::class,'logout'])->name('userlogout.logout');
	 
	
	
	
	
	
	
	

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
