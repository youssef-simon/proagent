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
		  posts:Object,
		 errors:Object
	 },setup(){
		 
	 }, methods:{
	  destroy(id) {
				if (confirm("Are you sure you want to Delete")) {
         
					router.delete(route("post.delete", id));
				}
			},
	 }
}
</script>

<template>
    <Head title="Dashboard" />

      
	
	<AppLayout :breadcrumbs="breadcrumbs">
  <div class="p-4 mb-6">
    <div class="w-full mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">post</h1>
            <a :href="route('post.create')" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Create Post
            </a>
        </div>
        
	
<h1>{{  __("forum") }}</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                         
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                       
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-for="post in posts.data"> 
                       <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
					   {{ post.title }}
                        </td>
                     
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a :href="route('post.edit',post.id)" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                          <a @click="destroy(post.id)" class="text-red-600 hover:text-red-900">Delete</a>
                        </td>
                    </tr>
 
                </tbody>
            </table>
        </div>
    </div>
    </div>
</AppLayout>



	
	
	
	
	
	
	
</template>
