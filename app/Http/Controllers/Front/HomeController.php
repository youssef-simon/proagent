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
use App\Models\Category;
use App\Models\Subject;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

$taxonomies = [
    'taxonomy' => [
        [
            'category' => 'التصميم والجرافيكس',
            'slug' => 'design-graphics',
            'subcategories' => [
                [
                    'name' => 'تصميم الشعارات',
                    'slug' => 'logo-design'
                ],
                [
                    'name' => 'هوية العلامة التجارية',
                    'slug' => 'brand-identity'
                ],
                [
                    'name' => 'جرافيكس وسائل التواصل الاجتماعي',
                    'slug' => 'social-media-graphics'
                ],
                [
                    'name' => 'الرسم والفن الرقمي',
                    'slug' => 'illustration-digital-art'
                ],
                [
                    'name' => 'التصميم للطباعة',
                    'slug' => 'print-design'
                ],
                [
                    'name' => 'تصميم التغليف',
                    'slug' => 'packaging-design'
                ]
            ]
        ],
        [
            'category' => 'التسويق الرقمي',
            'slug' => 'digital-marketing',
            'subcategories' => [
                [
                    'name' => 'التسويق عبر وسائل التواصل الاجتماعي',
                    'slug' => 'social-media-marketing'
                ],
                [
                    'name' => 'تحسين محركات البحث',
                    'slug' => 'seo'
                ],
                [
                    'name' => 'التسويق عبر البريد الإلكتروني',
                    'slug' => 'email-marketing'
                ],
                [
                    'name' => 'التسويق بالمحتوى',
                    'slug' => 'content-marketing'
                ],
                [
                    'name' => 'إعلانات الدفع بالنقرة',
                    'slug' => 'ppc'
                ],
                [
                    'name' => 'التسويق بواسطة المؤثرين',
                    'slug' => 'influencer-marketing'
                ]
            ]
        ],
        [
            'category' => 'الكتابة والترجمة',
            'slug' => 'writing-translation',
            'subcategories' => [
                [
                    'name' => 'كتابة المحتوى',
                    'slug' => 'content-writing'
                ],
                [
                    'name' => 'كتابة الإعلانات والنصوص التسويقية',
                    'slug' => 'copywriting'
                ],
                [
                    'name' => 'الكتابة التقنية',
                    'slug' => 'technical-writing'
                ],
                [
                    'name' => 'كتابة السير الذاتية ورسائل التعريف',
                    'slug' => 'resume-cover-letter-writing'
                ],
                [
                    'name' => 'الترجمة',
                    'slug' => 'translation'
                ]
            ]
        ],
        [
            'category' => 'الفيديو والرسوم المتحركة',
            'slug' => 'video-animation',
            'subcategories' => [
                [
                    'name' => 'مونتاج وتحرير الفيديو',
                    'slug' => 'video-editing-production'
                ],
                [
                    'name' => 'الرسوم المتحركة والموشن جرافيك',
                    'slug' => 'animation-motion-graphics'
                ],
                [
                    'name' => 'رسوم الفيديو والسبورة البيضاء',
                    'slug' => 'whiteboard-explainer-videos'
                ],
                [
                    'name' => 'الرسوم المتحركة ثلاثية الأبعاد',
                    'slug' => '3d-animation-modeling'
                ],
                [
                    'name' => 'مقاطع الفيديو القصيرة',
                    'slug' => 'short-form-video'
                ]
            ]
        ],
        [
            'category' => 'البرمجة والتقنية',
            'slug' => 'programming-tech',
            'subcategories' => [
                [
                    'name' => 'تطوير الويب',
                    'slug' => 'web-development'
                ],
                [
                    'name' => 'تطوير تطبيقات الهواتف',
                    'slug' => 'mobile-app-development'
                ],
                [
                    'name' => 'تطوير المتاجر الإلكترونية',
                    'slug' => 'e-commerce-development'
                ],
                [
                    'name' => 'تطوير الألعاب',
                    'slug' => 'game-development'
                ],
                [
                    'name' => 'ضمان الجودة والاختبار',
                    'slug' => 'qa-testing'
                ],
                [
                    'name' => 'الذكاء الاصطناعي وتعلم الآلة',
                    'slug' => 'ai-machine-learning'
                ],
                [
                    'name' => 'بلوك تشين والعملات الرقمية',
                    'slug' => 'blockchain-cryptocurrency'
                ],
                [
                    'name' => 'الحوسبة السحابية و DevOps',
                    'slug' => 'cloud-computing-devops'
                ],
                [
                    'name' => 'النظم المدمجة وإنترنت الأشياء',
                    'slug' => 'embedded-systems-iot'
                ],
                [
                    'name' => 'الأمن السيبراني',
                    'slug' => 'cybersecurity'
                ]
            ]
        ],
        [
            'category' => 'الهندسة والعلوم',
            'slug' => 'engineering-science',
            'subcategories' => [
                [
                    'name' => 'الهندسة الميكانيكية',
                    'slug' => 'mechanical-engineering'
                ],
                [
                    'name' => 'الهندسة الكهربائية',
                    'slug' => 'electrical-engineering'
                ],
                [
                    'name' => 'الهندسة المدنية',
                    'slug' => 'civil-engineering'
                ],
                [
                    'name' => 'الهندسة الكيميائية',
                    'slug' => 'chemical-engineering'
                ],
                [
                    'name' => 'علوم البيانات والتحليل',
                    'slug' => 'data-science-analytics'
                ],
                [
                    'name' => 'البحث العلمي',
                    'slug' => 'scientific-research'
                ],
                [
                    'name' => 'التكنولوجيا الحيوية وعلوم الحياة',
                    'slug' => 'biotechnology-life-sciences'
                ],
                [
                    'name' => 'الطاقة المتجددة',
                    'slug' => 'renewable-energy'
                ]
            ]
        ],
        [
            'category' => 'الأعمال والاستشارات',
            'slug' => 'business-consulting',
            'subcategories' => [
                [
                    'name' => 'خطط العمل',
                    'slug' => 'business-plans'
                ],
                [
                    'name' => 'أبحاث السوق',
                    'slug' => 'market-research'
                ],
                [
                    'name' => 'الاستشارات المالية',
                    'slug' => 'financial-consulting'
                ],
                [
                    'name' => 'استشارات startups والتأسيس',
                    'slug' => 'startup-incorporation-consulting'
                ],
                [
                    'name' => 'الاستشارات القانونية',
                    'slug' => 'legal-consulting'
                ],
                [
                    'name' => 'الاستشارات التقنية',
                    'slug' => 'technical-consulting'
                ]
            ]
        ],
        [
            'category' => 'الموسيقى والصوت',
            'slug' => 'music-audio',
            'subcategories' => [
                [
                    'name' => 'تعليق صوتي',
                    'slug' => 'voice-over'
                ],
                [
                    'name' => 'mونتاج وتحرير الصوت',
                    'slug' => 'audio-editing-production'
                ],
                [
                    'name' => 'كتابة الأغاني',
                    'slug' => 'songwriting'
                ],
                [
                    'name' => 'إنتاج البودكاست',
                    'slug' => 'podcast-production'
                ],
                [
                    'name' => 'المؤثرات الصوتية',
                    'slug' => 'sound-effects'
                ]
            ]
        ],
        [
            'category' => 'نمط الحياة والإبداع',
            'slug' => 'lifestyle-creativity',
            'subcategories' => [
                [
                    'name' => 'التصوير الفوتوغرافي',
                    'slug' => 'photography'
                ],
                [
                    'name' => 'تصميم الأزياء',
                    'slug' => 'fashion-design'
                ],
                [
                    'name' => 'تصميم الديكور الداخلي',
                    'slug' => 'interior-design'
                ],
                [
                    'name' => 'التدريب على الصحة واللياقة البدنية',
                    'slug' => 'health-fitness-coaching'
                ],
                [
                    'name' => 'التنجيم وقراءة الطالع',
                    'slug' => 'astrology-fortune-telling'
                ]
            ]
        ],
        [
            'category' => 'الخدمات الفنية والحرفية',
            'slug' => 'technical-craft-services',
            'subcategories' => [
                [
                    'name' => 'سباكة وإصلاح مواسير المياه',
                    'slug' => 'plumbing-pipe-repair'
                ],
                [
                    'name' => 'أعمال الكهرباء والتركيبات',
                    'slug' => 'electrical-works-installations'
                ],
                [
                    'name' => 'تكييف وتبريد',
                    'slug' => 'hvac'
                ],
                [
                    'name' => 'نقاشة ودهان',
                    'slug' => 'painting-plastering'
                ],
                [
                    'name' => 'نجارة وتركيب أرضيات',
                    'slug' => 'carpentry-flooring-installation'
                ],
                [
                    'name' => 'تركيب وصيانة الألواح الشمسية',
                    'slug' => 'solar-panel-installation-maintenance'
                ],
                [
                    'name' => 'تركيب الأجهزة المنزلية',
                    'slug' => 'appliance-installation'
                ],
                [
                    'name' => 'صيانة عامة للمنازل',
                    'slug' => 'general-home-maintenance'
                ],
                [
                    'name' => 'لحام',
                    'slug' => 'welding'
                ],
                [
                    'name' => 'تركيب اللوحات الكهربائية والأنظمة الذكية',
                    'slug' => 'electrical-panel-smart-systems-installation'
                ]
            ]
        ]
    ]
]; 




/*  foreach($taxonomies['taxonomy'] as $taxonomy){
							$taxonomy['category'];
							$data['title']=$taxonomy['category'];
							$data['description']=$taxonomy['category'];
							 
							
						$parentCat  = Category::create($data);
						
						
					foreach($taxonomy['subcategories'] as $childItm){
							$datachild['title']=$childItm['name'];
							$datachild['description']= $childItm['name'];
						 		$datachild['category_id'] = $parentCat->id;
							
							 Subject::create($datachild);
					}
			}  


 */









	  	 	/*  foreach($taxonomies['taxonomy'] as $taxonomy){
							$taxonomy['category'];
							$data['name']=$taxonomy['category'];
							$data['description']=$taxonomy['category'];
							$data['slug']= $taxonomy['slug'];
							
							
						$parentCat  = Category::create($data);
						
						
					foreach($taxonomy['subcategories'] as $childItm){
							$datachild['title']=$childItm['name'];
							$datachild['description']= $childItm['slug'];
							$datachild['slug']=  $childItm['slug'];
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
