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
			comment:Object,
			post:Object,
		 errors:Object
	 },setup(props){
		 const form = reactive({
		  
				body: '', 
				//post_id: props.post.id, 
				comment_id: props.comment.id, 
			})
			return { form }
	 }, methods:{
	 
	 submit() {
		  
		   router.post(route('store_reply'), this.form, {
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
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Reply Comment</h2>
    <form class="space-y-6" @submit.prevent="submit"> 
       <div class="p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ post.title }}</h2>
				
				<div class="p-2">
					<div class="textCont">{{ post.description }}</div>
				</div>
				
				
					<div class="p-2">
					<div class="textCont">{{ comment.body }}</div>
				</div>
				</div>
      <div>
        <label for="body" class="block text-sm font-medium text-gray-700 mb-1">body</label>
        <textarea 
          id="body" 
          name="body" 
          rows="4" 
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
          placeholder="Enter body"
		  
		  v-model="form.body"
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
