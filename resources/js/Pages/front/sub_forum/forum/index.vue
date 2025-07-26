<script   >
import AppLayout from '@/layouts/AppFrontLayout.vue';
 
import { Head } from '@inertiajs/vue3'; 
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'

 




export default{
	components:{
		AppLayout,reactive,router
	 }
	  ,
	   data() {
					return {
						submit_form:false , 
					 
					}
		  } 
	 
	 ,props:{
			
		 categories:Object,
		 errors:Object
	 },setup(){
		 const form = reactive({
		 
				title: '', 
				description: '', 
			})
			return { form }
	 }, methods:{
	 
	 submit() {
		  
		/*    router.post(route('category.store'), this.form, {
															onProgress: () => (this.submit_form=true),
															  onError: () =>(this.submit_form=false),

														});   */
		}
	 }
}
</script>

<template>
    <Head title="Dashboard" />
	
	



    <AppLayout>
    <div class="w-full mx-auto">
     
		
		
		
		
		
			<template  v-for="catItm in categories.data">
	
	
	<div class="  p-4 mb-1">
					<h2 class="p-2 text-2xl">{{ catItm.title }}</h2>
					 
						
									<table class="min-w-full divide-y divide-gray-200">
									  <thead class="bg-gray-50">
											<tr>
											<th scope="col" style="width:80%"  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Forum</th>
											<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posts</th>
											<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
														latest post
											</th>
											</tr>
										   </thead>
										<tr v-for="subject in catItm.subjects">
											<td style="width:80%"  class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
											<a  class="text-blue-600   hover:text-blue-800 hover:underline text-xl font-bold"  :href="route('post.index',subject.id)">
													{{ subject.title  }}
												
													 
											</a>
											<p>	{{ subject.description  }}</p>
											
											</td>
											<td  class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ subject.posts_count  }}</td> 
											<td  class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
											 
											<template v-if="subject.latest_approved_post">
											{{ subject.latest_approved_post.title  }}
											<br>
												بواسطة	:	{{ subject.latest_approved_post.author.name  }} 
											</template>
											</td> 
										</tr>
									</table>

 
			</div>
</template>
		
    </div>
    </AppLayout>
</template>
