<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
		@php
			$lang="ar";
		 
		@endphp
			 
    </head>
	@if($lang=="ar")
		<script>
			window._translations={
				"home":"الرئيسية" ,
				"freelancers":"المحترفيين" ,
				"taxanomy":"التصنيفات" ,
				"forums":"المنتدى" ,
				
				"register":"تسجيل" ,
						"login":"الدخول" ,
						"my_dashboard":"لوحة التحكم" ,
						"logout":"الخروج" ,
						
						"my_notifications":"الاشعارات" ,
						"my_servcies":"الخدمات" ,
						"my_messages":"الرسائل" ,
						"edit_profile":"تعديل البيانات" ,
						"my_previous_projects":"الاعمال و الخبرات السابقة" ,
						"my_links":"الروبط الخاصة بى" ,
						"cv_tab":"السيرة الذاتية" ,
						
						
							
						"first_name":"الاسم الاول" ,
						"last_name":"الاسم الاخير" ,
						"email":"الايميل" ,
						"phone":"الهاتف" ,
						"password":"كلمة السر" ,
						"password_confirmation":"تاكيد كلمة السر" ,
						"forget_password":"هل نسيت كلمة السر" ,
						"photo":"صورة" ,
						"save":"حفظ" ,
						  "work_title":" المسمى الوظيفى  " ,
						  	"small_bio":"السيرة المصغرة" ,
						"skills":"مهارات" ,
						"add_service":" اضف خدمة" ,
						"title":"العنوان" ,
						"description":"الوصف" ,
						"price_from":"السعر يبدا" ,
						"departement":"القطاع" ,
						"category":"التصنيف" ,
						"main_image":"الصورة الرئيسية" ,
						"other_images":"الصور الاخرى" ,
						
							"add_prev_project":" اضف مشروع او خبرة او انجاز سابق" ,
							"add_link":" اضف رابط" ,
							"status":"الحالة" ,
							
							"add":"اضف" ,
							"remove":"حذف" ,
							"upload_image":"ارفع صورة" ,
							"notifictions":"الاشعارات" ,
							"latest_post":"اخر منشور" ,
							"posts_number":"عدد المنشورات" ,
							"by":" بواسطة" ,
							"author":"بواسطة" ,
							"comments":"عدد التعليقات" ,
							"last_comment":"اخر تعليق" ,
							"forum":"المنتدى" ,
							"create_post":"اضف منشور" ,
							"created_at":"تاريخ الانشاء" ,
				};
		</script>
	@else
		<script>
			window._translations={
					"home":"Home" ,
					"freelancers":"Freelancers" ,
					"taxanomy":"Taxanomy" ,
					"forums":"Forums" ,
					
						"register":"Register" ,
						"login":"Login" ,
						"my_dashboard":"My Dashboard" ,
						"logout":"Logout" ,
					
						"my_notifications":"My Notifications" ,
						"my_servcies":"My Servcies" ,
						"my_messages":"My Messages" ,
						"edit_profile":"Edit Profile" ,
						"my_previous_projects":"My Previous Projects / Experinces" ,
						"my_links":"My Links" ,
						
						"cv_tab":"My Biography" ,
						
						"first_name":"First Name" ,
						"last_name":"Last Name" ,
						"email":"Email" ,
						"phone":"Phone" ,
						"password":"Password" ,
						"password_confirmation":"Password Confirmation" ,
						
							"forget_password":"forget password" ,
							
							"photo":"photo" ,
							"save":"Save" ,
							"work_title":"Job Title" ,
								  "small_bio":"Small Bio" ,
								  "skills":"Skills" ,
								  		"add_service":"Add Servcie" ,
											"title":"title" ,
											
											"description":"description" ,
						"price_from":"price from" ,
						"departement":"departement" ,
						"category":"category" ,
						"main_image":"main image" ,
						"other_images":"other images" ,
						"add_prev_project":"add previous project / Experinces" ,
							"status":"Status" ,
							
							"add":"Add" ,
							"remove":"Remove" 
								"upload_image":"Upload Image" ,
								"notifictions":"Notifictions" ,
								"latest_post":"latest post" ,
									"posts_number":"posts number" ,
									"by":"By" ,
									"forum":"forum" ,
									"create_post":"Create Post" ,
											"created_at":"created at" ,
				};
		</script>
	@endif
    <body class="font-sans antialiased lang_{{ $lang }}">
		@inertia
    </body>
</html>
