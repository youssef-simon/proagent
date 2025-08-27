<script   lang="ts">
import AppLayout from '@/layouts/AppFrontLayout.vue';



import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
 
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'

 

import { Modal } from 'usemodal-vue3'; 



export default{
	components:{
		AppLayout,reactive,router,Modal
	 }
	  ,
	   data() {
					return {
						editPic:false  , 
						submit_form:false  , 
						user :usePage().props.auth.user
						
					}
		  } 
	 
	 ,props:{
			
		 postFormFieldArr:Object,
		 comments:Object,
		 post:Object,
		 errors:Object
	 },setup(props){
		 const form = reactive({
		  
				body: '', 
				post_id: props.post.id, 
			});
			
			const formcomment= reactive({
		  
				body: '', 
				id:'', 
			});
			
		const	form_reply= reactive({
		  
				body: '',  
			});
			
			
			
			
			
			
			const	breadcrumbs =   [
								{
									title: 'Forum',
									href: '/',
								},
								{
									title: props.post.subject.title,
									 href: '/posts/'+props.post.subject.id,
								},
							 
								{
									title: props.post.title,
									 
								} 
							] ;
			return { form , formcomment, form_reply, breadcrumbs}
	 },  methods:{
			destroy(id) {
				if (confirm("Are you sure you want to Delete")) {
         
					router.delete(route("post.destory_comment", id));
				}
			},
		 submit() {
		  
		   router.post(route('post.store_comment'), this.form, {
															onProgress: () => (this.submit_form=true),
															  onError: () =>(this.submit_form=false),

														});  
														
														this.form.body= "";
		},
			  getFileIcon(fileType) {
    if (!fileType) return 'fas fa-file';
    
    const type = fileType.split('/')[0];
    const subtype = fileType.split('/')[1];
    
    switch(type) {
      case 'image':
        return 'fas fa-file-image';
      case 'audio':
        return 'fas fa-file-audio';
      case 'video':
        return 'fas fa-file-video';
      case 'application':
        if (subtype.includes('pdf')) return 'fas fa-file-pdf';
        if (subtype.includes('msword') || subtype.includes('wordprocessing')) return 'fas fa-file-word';
        if (subtype.includes('spreadsheet')) return 'fas fa-file-excel';
        if (subtype.includes('presentation')) return 'fas fa-file-powerpoint';
        if (subtype.includes('zip')) return 'fas fa-file-archive';
        return 'fas fa-file-code';
      case 'text':
        return 'fas fa-file-alt';
      default:
        return 'fas fa-file';
    }
  },
  
   submitReply(comment){
			this.form_reply.comment_id=comment.id;
				  
		   router.post(route('store_reply'), this.form_reply, {
															onProgress: () => (this.submit_form=true),
															  onError: () =>(this.submit_form=false),

														}); 
														 
														this.form_reply.body="";
		  
   },
   editComment(comment){
	   
	 this.editPic=true;
					this.formcomment.body=comment.body;
					this.formcomment.id=comment.id;
					
					console.log(this.formcomment);
				},submitComment(){
					
					
					router.post(route('post.update_comment',{id:this.formcomment.id}), this.formcomment, {
															onProgress: () => (this.submit_form=true),
															  onError: () =>(this.submit_form=false),
								});  
								
								
									this.formcomment.body= "";
					
				}
				
	 }
}
</script>

<template>
    <Head title="Dashboard" />

<AppLayout :breadcrumbs="breadcrumbs">




<ul>
	<template v-for="breadcrumb in breadcrumbs">
		<li>	{{  breadcrumb.title }} - {{  breadcrumb.href }}   </li> 
	</template>
		</ul>









  <div class="p-4 mb-6">
    <div class="w-full mx-auto py-8">
      
        
        <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ post.title }} </h2>
				
				
				<template v-for="(tagItm , kddey) in post.form_data">
													  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-1 mb-1">
														{{ postFormFieldArr[kddey] }} : {{ tagItm }} 
													  </span>
													</template>
				<div class="p-2 textEditor">
					<div class="textCont" v-html="post.description"></div>
				</div>
				
				             <!-- Improved Image Gallery -->
                <div class="flex flex-wrap gap-4 my-6">
                    <template v-for="imageItm in post.images"> 
                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-2">
                            <div class="relative aspect-square overflow-hidden rounded-lg bg-gray-100 hover:shadow-md transition-shadow duration-200">
                                <img 
                                    :src="imageItm.image_show" 
                                    class="object-cover w-full h-full hover:scale-105 transition-transform duration-300"
                                    alt="Post image"
                                />
                            </div>
                        </div>
                    </template>
                </div>
			 
				  <div class="flex flex-wrap gap-4 my-6">
                    <template v-for="fileItm in post.files"> 
                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-2">
                            <div class="relative overflow-hidden rounded-lg bg-gray-100 hover:shadow-md transition-shadow duration-200">
                               <p class="p-4"><a :href="fileItm.file_show">
							      <!--  <i :class="getFileIcon(fileItm.filetype) + ' text-4xl text-gray-500 mb-2'"></i>-->
							   
							   {{ fileItm.original_name }}</a></p>
                            </div>
                        </div>
                    </template>
                </div>
                
				
				
			<div class="w-full md:w-1/2  p-5	bg-gray-100  mb-4 flex"> 
					<div class="md:grid md:grid-cols-3 gap-4 "> 
							  <div class="imgUser">
							 		<a  href="#">
								<img :src="post.author.image_path_show" />
							  </a>
							  </div>
							  
							  
							  <div class="col-span-2">
								<h2 class=" text-lg">
								 <a  :href="route('user.user_details',{id: post.author.slug })">
								 {{ post.author.full_name }}
								</a>
								 <p>  {{ post.author.work_title }}</p> 
								</h2>
								<div class="txtDesc text-sm">{{ post.author.small_bio }}</div>
								<div class="txtDesc text-sm">{{ post.author.work_title }}</div>
							  
							  </div>
						</div>
				</div>
				
				
				
				
				  <div class="flex justify-between items-center mb-8">
           
            <a class="btn bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition duration-200" 
               :href="route('post.create_comment',post.id)">
                Create Comment
            </a>
        </div>
                <div class="border-t border-gray-200 pt-4">
                    <h3 class="text-lg font-medium text-gray-700 mb-6">Comments:</h3>
                    
                <template v-for="comment in comments.data">
    <div class="border border-gray-200 rounded-lg mb-6 overflow-hidden">
        <div class="flex h-full">
            <!-- Left side - User info -->
            <div class="w-1/4 p-4 bg-gray-50 border-r border-gray-200 flex min-h-[200px] flex-col">
                <div class="md:flex items-center space-x-3 mb-4">
                    <div class="bg-gray-200 rounded-full md:w-10  w-full  h-10 flex items-center justify-center overflow-hidden">
                        <template v-if="comment.user">
							<a :href="route('user.user_details',{id: comment.user.slug })">
                            <img class="w-full h-full object-cover" :src="comment.user.image_path_show" />
							</a>
                        </template>
                    </div>
                    <div class="w-full">
                        <p class="font-medium text-gray-900">
                            <template v-if="comment.user">
							<a  :href="route('user.user_details',{id: comment.user.slug })">
                                {{ comment.user.full_name }}
								</a> 
								<p>  {{ comment.user.work_title }}</p>
                            </template>
                        </p>
                    </div>
                </div>
                <div class="mt-auto">
                    <p class="text-xs text-gray-500">{{ comment.created_at }}</p>
                    <!-- Edit and Delete Links -->
                    <div v-if="user" >
						<div v-if="comment.user_id==user.id" class="flex space-x-2 mt-2">
							<a  @click="editComment(comment)" href="javascript::void(0)" 
							   class="text-xs text-blue-600 hover:underline ddddddddddddddddddddddddddddddddddddddddddd">
								Edit
							</a>
							<a   @click="destroy( comment.id)"
							   class="text-xs text-red-600 hover:underline"
							  >
								Delete
							</a>
						</div>
                    </div>
                </div>
            </div>
            
            <!-- Right side - Comment text -->
            <div class="w-3/4 p-6 flex flex-col">
                <p class="text-gray-700 whitespace-pre-line mb-4">{{ comment.body }}</p>
                      <template v-if="user" >
					  
					  
					     <div v-if="comment.replies && comment.replies.length > 0" class="border-t border-gray-100 pt-4">
                    <h4 class="text-sm font-medium text-gray-500 mb-3">Replies:</h4>
                    
                    <div v-for="reply in comment.replies" class="bg-gray-50 rounded-lg p-4 mb-3">
                        <div class="flex items-start space-x-3">
                            <div class="bg-gray-200 rounded-full w-8 h-8 flex-shrink-0 overflow-hidden">
                                <template v-if="reply.user">
                                    <img class="w-full h-full object-cover" :src="reply.user.avatar_show" />
                                </template>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-baseline justify-between">
                                    <p class="text-sm font-medium text-gray-900">
                                        <template v-if="reply.user">
                                            {{ reply.user.name }}
                                        </template>
                                    </p>
                                    <span class="text-xs text-gray-500">{{ reply.created_at }}</span>
                                </div>
                                <p class="text-sm text-gray-700 whitespace-pre-line mt-1">{{ reply.body }}</p>
                                <!-- Reply Edit/Delete Links -->
                                <template v-if="user" >
									<div v-if="reply.user_id==user.id" class="flex space-x-2 mt-2">
										<a href="route('post.edit_reply', {'id': reply.id})" 
										   class="text-xs text-blue-600 hover:underline">
											Edit
										</a>
										<a  href="route('post.delete_reply', {'id': reply.id})" 
										   class="text-xs text-red-600 hover:underline"
										   onclick="return confirm('Are you sure you want to delete this reply?')">
											Delete
										</a>
									</div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Improved Reply Link -->
                <a  href="route('create_reply', {id: comment.id})"  @click=""
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                    </svg>
                    Reply to this comment
                </a>
				
				  <div class="w-full mx-auto bg-white rounded-xl shadow-md overflow-hidden   p-6">
    
							<form class="space-y-6" @submit.prevent="submitReply(comment)"> 
							   
							  <div>
								<label for="body" class="block text-sm font-medium text-gray-700 mb-1">reply</label>
								<textarea 
								  id="body" 
								  name="body" 
								  rows="4" 
								  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
								  placeholder="Enter body"
								  
								  v-model="form_reply.body"
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
  
				
                </template> 
             
            </div>
        </div>
    </div>
</template>
                    
                    <div v-if="comments.data.length === 0" class="text-gray-500 italic py-8 text-center">
                        No comments yet. Be the first to comment!
                    </div>
                </div>
				
				
				
				
				
				
				
				
				
				
				
				  <div class="w-full mx-auto bg-white rounded-xl shadow-md overflow-hidden   p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Create Comment</h2>
							<form class="space-y-6" @submit.prevent="submit"> 
							   
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
    </div>
    </div>
	
	
	
	
	
	
	
	
	
	
	
	
   	<Modal v-model:visible="editPic"
		v-bind:okButton="{ 
		onclick: submitComment,
		text :'Ok'
	
	}"  >
								<div class="row">
									 <div class="col-md-12">
									 		  <div>
													<label for="body" class="block text-sm font-medium text-gray-700 mb-1">body</label>
													<textarea 
													  id="body" 
													  name="body" 
													  rows="4" 
													  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
													  placeholder="Enter body"
													  
													  v-model="formcomment.body"
													></textarea>
												  </div>
													</div>
									</div>
									 
							</Modal>	
			  
			  
	
	
	
	
	
	
	
	
	
	
</AppLayout>
</template>
