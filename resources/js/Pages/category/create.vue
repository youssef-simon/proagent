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
			
		 errors:Object
	 },setup(){
		 const form = reactive({
		 
				title: '', 
				description: '', 
			})
			return { form }
	 }, methods:{
	 
	 submit() {
		  
		   router.post(route('category.store'), this.form, {
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
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Create Category</h2>
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
