<script   lang="ts">
import AppLayout from '@/layouts/AppFrontLayout.vue';
 
import { Head } from '@inertiajs/vue3'; 
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'


 



export default{
	components:{
		AppLayout,reactive,router
	 }
	  ,
	   data() {
					return {
						submit_form:false  , 
					
					}
		  } 
	 
	 ,props:{
			
		 id:String,
		 postFormFields:Object,
		 postFormFieldArr:Object,
		 subject:Object,
		 posts:Object,
		 pinnedPosts:Object,
		 dataArr:Object,
		 errors:Object
	 },setup(props){
		 const form = reactive({
		  
			form_data: {}, 				
			})
			
			
			
			
			
			const	breadcrumbs =   [
								{
									title: 'Forum',
									href: '/',
								},
								{
									title: props.subject.title,
									 
								},
							] ;
			
			
			
			return { form,breadcrumbs }
	 }, methods:{
	 
	 submit() {
		  console.log( this.form);
		    router.get(route('post.index',this.id ), this.form.form_data);  
		} 
		,
		 destroy(id) {
				if (confirm("Are you sure you want to Delete")) {
         
					router.delete(route("admin.delete", id));
					
				}
			},
		
		
		
	 },created(){
		 console.log(this.dataArr);
				// this.form.form_data
				//this.dataArr.each(function(){
					
					Object.entries(this.dataArr).forEach(([key, value]) => {
									  console.log(key, value);
									  this.form.form_data[key]=value;
									});
		 
				//});
	 }
}
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout  >
	
		<div class="p-4 mb-6">
			<div class="w-full mx-auto"> 
				
		 <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ subject.title }}</h1>
            <a :href="route('post_inside.create',subject.id)" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                	create_post
            </a>
        </div>
				
				 
				
			 
			 <template v-if="postFormFields.length">
		<form class="w-full p-6 bg-white rounded-lg shadow-md">
  <div class="flex flex-wrap -mx-2">
    <div 
      v-for="(field, index) in postFormFields" 
      :key="index" 
      class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4"
    >
      <!-- Label -->
      <label 
        :for="field.field_key" 
        class="block text-sm font-medium text-gray-700 mb-1"
      >
        {{ field.field_label }}
        <span v-if="field.required" class="text-red-500">*</span>
      </label>
      
      <!-- Text Input -->
      <input 
        v-if="field.field_type === 'text' || field.field_type === 'email' || field.field_type === 'password'"
        :type="field.field_type"
        :id="field.field_key"
        v-model="form.form_data[field.field_key]"
        :placeholder="field.placeholder || ''"
        :required="field.required || false"
        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150"
      >
      
      <!-- Textarea -->
      <textarea 
        v-else-if="field.field_type === 'textarea'"
        :id="field.field_key"
        v-model="form.form_data[field.field_key]"
        :placeholder="field.placeholder || ''"
        :required="field.required || false"
        :rows="field.rows || 3"
        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150"
      ></textarea>
      
      <!-- Select Dropdown -->
      <select 
        v-else-if="field.field_type === 'select'"
        :id="field.field_key"
        v-model="form.form_data[field.field_key]"
        :required="field.required || false"
        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIGNsYXNzPSJsdWNpZGUgbHVjaWRlLWNoZXZyb24tZG93biI+PHBhdGggZD0ibTYgOSA2IDYgNi02Ii8+PC9zdmc+')] bg-no-repeat bg-[center_right_0.5rem] bg-[length:1.5em] transition duration-150"
      >
        <option value=""  selected>All</option>
        <option 
          v-for="option in field.field_options" 
          :value="option.option_text"
        >
          {{ option.option_text }}
        </option>
      </select>
      
      <!-- Checkbox -->
      <div 
        v-else-if="field.field_type === 'checkbox'"
        class="flex items-center"
      >
        <input 
          type="checkbox"
          :id="field.field_key"
          v-model="form.form_data[field.field_key]"
          class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
        >
        <label :for="field.field_key" class="ml-2 block text-sm text-gray-700">
          {{ field.field_label }}
        </label>
      </div>
      
      <!-- Radio Buttons -->
      <div 
        v-else-if="field.field_type === 'radio'"
        class="space-y-2"
      >
        <div 
          v-for="option in field.field_options" 
          :key="option.value"
          class="flex items-center"
        >
          <input 
            type="radio"
            :id="`${field.field_key}-${option.value}`"
            :value="option.value"
            v-model="form.form_data[field.field_key]"
            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
          >
          <label 
            :for="`${field.field_key}-${option.value}`" 
            class="ml-2 block text-sm text-gray-700"
          >
            {{ option.option_text }}
          </label>
        </div>
      </div>
    </div>
  </div>

  <!-- Submit Button -->
  <div class="mt-6 flex justify-end">
    <a href="javascript::void(0)"
      type="submit" @click="submit"
      class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150"
    >
      Submit
    </a>
  </div>
</form>
</template>
 
				<div class="bg-white shadow-md rounded-lg overflow-hidden">
				 
				 
						
							 
										
										
										
										
										
										
										<table class="min-w-full divide-y divide-gray-200">
										  <thead class="bg-gray-50">
													<tr>
														<th scope="col" style="width:80%" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">title</th>
							 
														<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
														<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comments</th>
														<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">last comments</th>
													</tr>
										   </thead>
										   
										   
										   <tr class="pinnedRow" v-for="postItm in pinnedPosts">
												<td style="width:80%" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
														<a   class="text-blue-600   hover:text-blue-800 hover:underline text-xl font-bold" :href="route('post.view',postItm.id)">
															{{ postItm.title }}
															
													</a>
													 		<p>  تاريخ الإنشاء : {{ postItm.created_at }}</p>
												 
												<template v-for="(tagItm , kddey) in postItm.form_data">
													  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-1 mb-1">
														{{ postFormFieldArr[kddey] }} : {{ tagItm }} 
													  </span>
													</template>
												</td>
												<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
													<template v-if="postItm.author">
												 {{ postItm.author.name }}
											 
														</template>
												</td>
												<td  class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ postItm.comments_count }}</td>
												<td  class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
															<template v-if="postItm.latest_approved_comment">
															<p>{{ postItm.latest_approved_comment.user.name }}	</p>
																<p>{{ postItm.latest_approved_comment.created_at }}	</p>
																</template>
															</td>
											</tr>
											
											<tr v-for="postItm in posts.data">
												<td style="width:80%" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
														<a   class="text-blue-600   hover:text-blue-800 hover:underline text-xl font-bold" :href="route('post.view',postItm.id)">
															{{ postItm.title }}
													</a>
													 
													<p>  تاريخ الإنشاء : {{ postItm.created_at }}</p>
												 
												<template v-for="(tagItm , kddey) in postItm.form_data">
													  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-1 mb-1">
														{{ postFormFieldArr[kddey] }} : {{ tagItm }} 
													  </span>
													</template>
												</td>
												<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
													<template v-if="postItm.author">
												 	{{ postItm.author.name }}
											 
														</template>
												</td>
												<td  class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ postItm.comments_count }}</td>
												
												
												<td  class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
															<template v-if="postItm.latest_approved_comment">
															<p>{{ postItm.latest_approved_comment.user.name }}	</p>
																<p>{{ postItm.latest_approved_comment.created_at }}	</p>
																</template>
															</td>
											</tr>
										</table>

						 
				</div>
			</div>
		</div>
		
		
    </AppLayout>
</template>
