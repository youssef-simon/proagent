<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\ServiceCategory;
use App\Models\Department;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

$taxonomies = [
    [
        'category' => 'Graphics & Design',
        'subcategories' => [
            'Logo Design',
            'Brand Identity',
            'Social Media Graphics',
            'Illustration & Art',
            'Print Design',
            'Packaging Design'
        ]
    ],
    [
        'category' => 'Digital Marketing',
        'subcategories' => [
            'Social Media Marketing',
            'SEO',
            'Email Marketing',
            'Content Marketing',
            'PPC Ads',
            'Influencer Marketing'
        ]
    ],
    [
        'category' => 'Writing & Translation',
        'subcategories' => [
            'Content Writing',
            'Copywriting',
            'Technical Writing',
            'Resume/Cover Letter Writing',
            'Translation'
        ]
    ],
    [
        'category' => 'Video & Animation',
        'subcategories' => [
            'Video Editing',
            'Motion Graphics',
            'Whiteboard Animation',
            '3D Animation',
            'Short-Form Video'
        ]
    ],
    [
        'category' => 'Programming & Tech',
        'subcategories' => [
            'Web Development',
            'Mobile App Development',
            'E-Commerce Development',
            'Game Development',
            'QA & Testing',
            'AI & Machine Learning',
            'Blockchain & Cryptocurrency',
            'DevOps & Cloud Computing',
            'Embedded Systems & IoT',
            'Cybersecurity'
        ]
    ],
    [
        'category' => 'Engineering & Science',
        'subcategories' => [
            'Mechanical Engineering',
            'Electrical Engineering',
            'Civil Engineering',
            'Chemical Engineering',
            'Data Science & Analytics',
            'Scientific Research',
            'Biotechnology & Life Sciences',
            'Renewable Energy'
        ]
    ],
    [
        'category' => 'Business & Consulting',
        'subcategories' => [
            'Business Plans',
            'Market Research',
            'Financial Consulting',
            'Startup Consulting',
            'Legal Consulting',
            'Technical Consulting'
        ]
    ],
    [
        'category' => 'Music & Audio',
        'subcategories' => [
            'Voiceovers',
            'Audio Editing',
            'Songwriting',
            'Podcast Production',
            'Sound Effects'
        ]
    ],
    [
        'category' => 'Lifestyle & Creative',
        'subcategories' => [
            'Photography',
            'Fashion Design',
            'Interior Design',
            'Health & Fitness Coaching',
            'Astrology & Tarot Reading'
        ]
    ]
];

	/* 		foreach($taxonomies as $taxonomy){
							$taxonomy['category'];
							$data['name']=$taxonomy['category'];
							$data['description']=$taxonomy['category'];
							$data['slug']=Str::slug($taxonomy['category']);
							
							
						$parentCat  = Department::create($data);
						
						
					foreach($taxonomy['subcategories'] as $childItm){
							$datachild['title']=$childItm;
							$datachild['description']=$childItm;
							$datachild['slug']=Str::slug($childItm);
							$datachild['department_id'] = $parentCat->id;
							
							 ServiceCategory::create($datachild);
					}
			}




 */


 
	   return Inertia::render('front/home');
    }



	
	 public function searchTags(Request $request)
    {
		
		$term = $request->get('term');
           
 		    $tags = Tag::where('name', 'like', $term.'%')->limit(10)->get();
			 
			  return response()->json([
							'data' =>$tags ,  
				]);	
				
    }










}
