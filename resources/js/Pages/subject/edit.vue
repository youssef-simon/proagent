<script   lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];


export default{
	components:{
		AppLayout,reactive,router
	 }
	  ,
	   data() {
					return {
						submit_form:false   
				   
					}
		  } 
	 
	 ,props:{
			categories:Object,
			subject:Object,
			errors:Object
	 },setup(props){
		 const form = reactive({ 
				title:props.subject.title, 
				description: props.subject.description,  
				category_id: props.subject.category_id, 
				view_perm: props.subject.view_perm, 
				post_perm: props.subject.post_perm, 
				comment_perm: props.subject.comment_perm, 
				comment_review: props.subject.comment_review, 
				post_review: props.subject.post_review, 
			})
			return { form }
	 }, methods:{
	 
	 submit() {
		  
		   router.post(route('subject.update',this.subject.id), this.form, {
															onProgress: () => (this.submit_form=true),
															  onError: () =>(this.submit_form=false),

														});  
		}
	 }
}
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
    <div class="w-full mx-auto">
	
	
		
	<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
  <div class="w-full mx-auto bg-white rounded-xl shadow-md overflow-hidden   p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Create Subject</h2>
    <form class="space-y-6" @submit.prevent="submit"> 
      <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
        <input 
          type="text" 
          id="title" 
          name="title" 
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
          placeholder="Enter title"
		  v-model="form.title"
        >
      </div>
      
      <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea 
          id="description" 
          name="description" 
          rows="4" 
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
          placeholder="Enter description"
		  
		  v-model="form.description"
        ></textarea>
      </div>
      
	    <div>
			  <label class="inline-flex items-center">
		  <input type="checkbox"  value="1" true-value="1" false-value="0"  v-model="form.view_perm"  class="form-checkbox h-5 w-5 text-blue-600">
		  <span class="ml-2 text-gray-700">need permission to view</span>
		</label>
		</div>
		
		 
		<div>
			  <label class="inline-flex items-center">
		  <input type="checkbox"  value="1" true-value="1" false-value="0"  v-model="form.post_perm"  class="form-checkbox h-5 w-5 text-blue-600">
		  <span class="ml-2 text-gray-700">need permission to add post</span>
		</label>
		</div>
		
		
		
		<div>
			  <label class="inline-flex items-center">
		  <input type="checkbox"  value="1" true-value="1" false-value="0"  v-model="form.comment_perm"  class="form-checkbox h-5 w-5 text-blue-600">
		  <span class="ml-2 text-gray-700">need permission to add comment</span>
		</label>
		</div>
		
		
		
		
			<div>
			  <label class="inline-flex items-center">
		  <input type="checkbox"  value="1" true-value="1" false-value="0"  v-model="form.post_review"  class="form-checkbox h-5 w-5 text-blue-600">
		  <span class="ml-2 text-gray-700">post need to be accepted before published</span>
		</label>
		</div>
		
		
		<div>
			  <label class="inline-flex items-center">
		  <input type="checkbox"  value="1" true-value="1" false-value="0"  v-model="form.comment_review"  class="form-checkbox h-5 w-5 text-blue-600">
		  <span class="ml-2 text-gray-700">comment need to be accepted before published</span>
		</label>
		</div>
		
		
		
		
		
		
		
		
		
	  
	    <div>
        <label for="categories" class="block text-sm font-medium text-gray-700 mb-1">categories</label>
		<select   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"   v-model="form.category_id">
				 <option v-for="serviceCategory in categories"    :value="serviceCategory.id">
														 {{ serviceCategory.title }}
												 </option> 
		</select>
          
      </div>
	  
	  
      <div>
        <button 
          type="submit" 
		  v-if="submit_form==false"
          class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Submit
        </button>
		
		
		<button 
          type="submit" 
		  v-if="submit_form==true"
          class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Submit
        </button>
      </div>
    </form>
  </div>
</div>
		
		
		
		
		
    </div>
    </AppLayout>
</template>
