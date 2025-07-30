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

  <!-- Breadcrumb Navigation -->
  <ol class="breadcrumb">
    <template v-for="breadcrumb in breadcrumbs">
      <li class="breadcrumb-item">
        <a :href="breadcrumb.href">{{ breadcrumb.title }}</a>
      </li>
    </template>
  </ol>

  <div class="containeraa">
    <!-- Post Content -->
    <div class="card mb-4">
      <div class="card-body">
	  <div class="row">
	  <div class="col-md-12">
        <h1 class="">{{ post.title }}</h1>
      </div>  
      </div>  
        <!-- Tags -->
        <div class="mb-3">
          <template v-for="(tagItm, kddey) in post.form_data">
            <span class="badge bg-primary mr-1 mb-1">
              {{ postFormFieldArr[kddey] }}: {{ tagItm }}
            </span>
          </template>
        </div>
        
        <!-- Post Content -->
        <div class="mb-4" v-html="post.description"></div>
        
        <!-- Images -->
        <div class="row mb-4">
          <template v-for="imageItm in post.images">
            <div class="col-md-3 col-6 mb-2">
              <img :src="imageItm.image_show" class="img-fluid img-thumbnail"/>
            </div>
          </template>
        </div>
        
        <!-- Files -->
        <div class="mb-4">
          <template v-for="fileItm in post.files">
            <div class="mb-2">
              <i class="far fa-file mr-2"></i>
              <a :href="fileItm.file_show">{{ fileItm.original_name }}</a>
            </div>
          </template>
        </div>
        
        <!-- Author -->
        <div class="media bg-light p-3 mb-4">
          <img :src="post.author.image_path_show" class="mr-3 rounded-circle" width="60" height="60"/>
          <div class="media-body">
            <h5 class="mt-0">
              <a :href="route('user.user_details',{id: post.author.slug })">
                {{ post.author.full_name }}
              </a>
            </h5>
            <p class="text-muted mb-1">{{ post.author.work_title }}</p>
            <p class="mb-0">{{ post.author.small_bio }}</p>
          </div>
        </div>
        
        <div class="text-right">
          <a :href="route('post.create_comment',post.id)" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Create Comment
          </a>
        </div>
      </div>
    </div>

    <!-- Comments Section -->
    <div class="card mb-4">
      <div class="card-header">
        <h2>Comments</h2>
      </div>
      <div class="card-body">
        <template v-if="comments.data.length > 0">
          <template v-for="comment in comments.data">
            <!-- Comment -->
            <div class="media mb-4 pb-4 border-bottom">
              <!-- Left Column - User Info -->
              <div class="mr-3 text-center" style="width: 120px">
                <template v-if="comment.user">
                  <a :href="route('user.user_details',{id: comment.user.slug })">
                    <img :src="comment.user.image_path_show" class="rounded-circle mb-2" width="60" height="60"/>
                  </a>
                  <div>
                    <a :href="route('user.user_details',{id: comment.user.slug })" class="d-block">
                      {{ comment.user.full_name }}
                    </a>
                    <small class="text-muted">{{ comment.user.work_title }}</small>
                  </div>
                </template>
              </div>
              
              <!-- Right Column - Comment Content -->
              <div class="media-body">
                <div class="d-flex justify-content-between mb-2">
                  <small class="text-muted">{{ comment.created_at }}</small>
                  <div v-if="user && comment.user_id==user.id">
                    <a @click="editComment(comment)" href="javascript:void(0)" class="text-primary mr-2">
                      <i class="fas fa-edit mr-1"></i>Edit
                    </a>
                    <a @click="destroy(comment.id)" class="text-danger">
                      <i class="fas fa-trash mr-1"></i>Delete
                    </a>
                  </div>
                </div>
                
                <p class="mb-3">{{ comment.body }}</p>
                
                <!-- Replies -->
                <template v-if="comment.replies && comment.replies.length > 0">
                  <div class="pl-3 border-left">
                    <h6 class="text-muted mb-3">Replies</h6>
                    <template v-for="reply in comment.replies">
                      <div class="media mb-3">
					  
                        <img :src="reply.user.image_path_show" class="mr-3 rounded-circle" width="40" height="40"/>
                        <div class="media-body">
                          <div class="d-flex justify-content-between mb-1">
                            <strong class="small"> {{ comment.user.full_name }}</strong>
                            <small class="text-muted">{{ reply.created_at }}</small>
                          </div>
                          <p class="small mb-2">{{ reply.body }}</p>
                          <div v-if="user && reply.user_id==user.id" class="small">
                            <a  href="route('post.edit_reply', {'id': reply.id})" class="text-primary mr-2">
                              <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <a  href="route('post.delete_reply', {'id': reply.id})" 
                               onclick="return confirm('Are you sure?')"
                               class="text-danger">
                              <i class="fas fa-trash mr-1"></i>Delete
                            </a>
                          </div>
                        </div>
                      </div>
                    </template>
                  </div>
                </template>
                
                <!-- Reply Form (Always Visible) -->
                <div class="mt-3 p-3 bg-light rounded">
                  <form @submit.prevent="submitReply(comment)">
                    <div class="form-group mb-2">
                      <textarea 
                        v-model="form_reply.body"
                        class="form-control"
                        rows="3"
                        placeholder="Write your reply..."
                        required
                      ></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">
                      <span v-if="!submit_form">Submit Reply</span>
                      <span v-else>Submitting...</span>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </template>
        </template>
        <template v-else>
          <div class="text-center text-muted py-4">
            No comments yet. Be the first to comment!
          </div>
        </template>
      </div>
    </div>

    <!-- Create Comment Form -->
    <div class="card">
      <div class="card-header">
        <h2>Create Comment</h2>
      </div>
      <div class="card-body">
        <form @submit.prevent="submit">
          <div class="form-group">
            <textarea 
              v-model="form.body"
              class="form-control"
              rows="4"
              placeholder="Write your comment..."
              required
            ></textarea>
          </div>
          <button type="submit" class="btn btn-primary">
            <span v-if="!submit_form">Submit Comment</span>
            <span v-else>Submitting...</span>
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Comment Modal -->
  <Modal v-model:visible="editPic" title="Edit Comment">
    <div class="modal-body">
      <div class="form-group">
        <textarea 
          v-model="formcomment.body"
          class="form-control"
          rows="5"
          required
        ></textarea>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" @click="editPic = false">Cancel</button>
      <button type="button" class="btn btn-primary" @click="submitComment">Save</button>
    </div>
  </Modal>
</AppLayout>
</template>
