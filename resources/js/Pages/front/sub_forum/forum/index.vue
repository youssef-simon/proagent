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
    <div class="container-fluid p-0">
        <template v-for="catItm in categories.data">
            <div class="card mb-3">
                <div class="card-header bg-primaryD forumTitle text-white">
                    <h2 class="h4 mb-0 p-2">{{ catItm.title }}</h2>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="width:60%" class="align-middle">Forum</th>
                                    <th scope="col" class="text-center align-middle">Posts</th>
                                    <th scope="col" class="align-middle">Latest Post</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="subject in catItm.subjects">
                                    <td class="align-middle">
                                        <a :href="route('post.index',subject.id)" 
                                           class="text-primary font-weight-bold d-block mb-1">
                                            {{ subject.title }}
                                        </a>
                                        <p class="text-muted small mb-0">{{ subject.description }}</p>
                                    </td>
                                    <td class="text-center align-middle">
                                        <span class="badge badge-pill badge-info">
                                            {{ subject.posts_count }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <template v-if="subject.latest_approved_post">
                                            <div class="d-flex flex-column">
                                                <span class="font-weight-bold text-truncate">
                                                    {{ subject.latest_approved_post.title }}
                                                </span>
                                                <small class="text-muted">
                                                    By: {{ subject.latest_approved_post.author.full_name }}
                                                </small>
                                            </div>
                                        </template>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </template>
    </div>
</AppLayout>
</template>
