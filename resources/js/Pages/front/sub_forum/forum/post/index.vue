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
         
					router.delete(route("post.delete", id));
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
<AppLayout>
  <!-- Breadcrumb Navigation -->
  <nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
      <template v-for="breadcrumb in breadcrumbs">
        <li class="breadcrumb-item">
          <a :href="breadcrumb.href">{{ breadcrumb.title }}</a>
        </li>
      </template>
    </ol>
  </nav>

  <div class="containerss mt-4">
    <div class="card shadow-sm mb-4">
      <div class="card-headerspec bg-white d-flex justify-between  align-items-center">
        <h2 class="h4 mb-0 text-primary">{{ subject.title }}</h2>
        <a :href="route('post_inside.create',subject.id)" class="btn btn-primary">
          <i class="fas fa-plus"></i> Create Post
        </a>
      </div>
      
      <!-- Dynamic Form Fields -->
      <template v-if="postFormFields.length">
        <div class="card-body">
          <form class="w-full p-4 bg-white rounded-lg">
            <div class="row g-3">
              <div 
                v-for="(field, index) in postFormFields" 
                :key="index" 
                class="col-md-6 col-lg-4"
              >
                <!-- Label -->
                <label 
                  :for="field.field_key" 
                  class="form-label"
                >
                  {{ field.field_label }}
                  <span v-if="field.required" class="text-danger">*</span>
                </label>
                
                <!-- Text Input -->
                <input 
                  v-if="field.field_type === 'text' || field.field_type === 'email' || field.field_type === 'password'"
                  :type="field.field_type"
                  :id="field.field_key"
                  v-model="form.form_data[field.field_key]"
                  :placeholder="field.placeholder || ''"
                  :required="field.required || false"
                  class="form-control"
                >
                
                <!-- Textarea -->
                <textarea 
                  v-else-if="field.field_type === 'textarea'"
                  :id="field.field_key"
                  v-model="form.form_data[field.field_key]"
                  :placeholder="field.placeholder || ''"
                  :required="field.required || false"
                  :rows="field.rows || 3"
                  class="form-control"
                ></textarea>
                
                <!-- Select Dropdown -->
                <select 
                  v-else-if="field.field_type === 'select'"
                  :id="field.field_key"
                  v-model="form.form_data[field.field_key]"
                  :required="field.required || false"
                  class="form-select"
                >
                  <option value="" selected>All</option>
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
                  class="form-check"
                >
                  <input 
                    type="checkbox"
                    :id="field.field_key"
                    v-model="form.form_data[field.field_key]"
                    class="form-check-input"
                  >
                  <label :for="field.field_key" class="form-check-label">
                    {{ field.field_label }}
                  </label>
                </div>
                
                <!-- Radio Buttons -->
                <div 
                  v-else-if="field.field_type === 'radio'"
                  class="form-group"
                >
                  <div 
                    v-for="option in field.field_options" 
                    :key="option.value"
                    class="form-check"
                  >
                    <input 
                      type="radio"
                      :id="`${field.field_key}-${option.value}`"
                      :value="option.value"
                      v-model="form.form_data[field.field_key]"
                      class="form-check-input"
                    >
                    <label 
                      :for="`${field.field_key}-${option.value}`" 
                      class="form-check-label"
                    >
                      {{ option.option_text }}
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-4 d-flex justify-content-end">
              <button 
                type="button" 
                @click="submit"
                class="btn btn-primary"
              >
                Submit
              </button>
            </div>
          </form>
        </div>
      </template>
      
      <!-- Posts Table -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead class="thead-light">
              <tr>
                <th scope="col" style="width: 50%;">Title</th>
                <th scope="col">Author</th>
                <th scope="col" class="text-center">Comments</th>
                <th scope="col">Last Comment</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Pinned Posts -->
              <tr class="table-warning" v-for="postItm in pinnedPosts">
                <td>
                  <a class="h5 font-weight-bold text-dark" :href="route('post.view',postItm.id)">
                    {{ postItm.title }}
                  </a>
                  <p class="text-muted small mb-0">Created: {{ postItm.created_at }}</p>
                  <div class="mt-2">
                    <template v-for="(tagItm, kddey) in postItm.form_data">
                      <span class="badge bg-primary text-white me-1 mb-1">
                        {{ postFormFieldArr[kddey] }}: {{ tagItm }}
                      </span>
                    </template>
                  </div>
                </td>
                <td class="align-middle">
                  <template v-if="postItm.author">
                    {{ postItm.author.full_name }}
                  </template>
                </td>
                <td class="align-middle text-center">
                  <span class="badge rounded-pill bg-info">{{ postItm.comments_count }}</span>
                </td>
                <td class="align-middle">
                  <template v-if="postItm.latest_approved_comment">
                    <span class="d-block">{{ postItm.latest_approved_comment.user.full_name }}</span>
                    <span class="text-muted small">{{ postItm.latest_approved_comment.created_at }}</span>
                  </template>
                </td>
                <td class="align-middle">
                  <div class="btn-group btn-group-sm">
                    <a :href="route('post.edit',postItm.id)" class="btn btn-outline-secondary">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a :href="route('post.delete',postItm.id)" class="btn btn-outline-danger">
                      <i class="fas fa-trash"></i>
                    </a>
                  </div>
                </td>
              </tr>
              
              <!-- Regular Posts -->
              <tr v-for="postItm in posts.data">
                <td>
                  <a class="h5 font-weight-bold text-dark" :href="route('post.view',postItm.id)">
                    {{ postItm.title }}
                  </a>
                  <p class="text-muted small mb-0">Created: {{ postItm.created_at }}</p>
                  <div class="mt-2">
                    <template v-for="(tagItm, kddey) in postItm.form_data">
                      <span class="badge bg-primary text-white me-1 mb-1">
                        {{ postFormFieldArr[kddey] }}: {{ tagItm }}
                      </span>
                    </template>
                  </div>
                </td>
                <td class="align-middle">
                  <template v-if="postItm.author">
                    {{ postItm.author.full_name }}
                  </template>
                </td>
                <td class="align-middle text-center">
                  <span class="badge rounded-pill bg-info">{{ postItm.comments_count }}</span>
                </td>
                <td class="align-middle">
                  <template v-if="postItm.latest_approved_comment">
                    <span class="d-block">{{ postItm.latest_approved_comment.user.name }}</span>
                    <span class="text-muted small">{{ postItm.latest_approved_comment.created_at }}</span>
                  </template>
                </td>
                <td class="align-middle">
                  <div class="btn-group btn-group-sm">
                    <a :href="route('post.edit',postItm.id)" class="btn btn-outline-secondary">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a href="javascript::void(0)" @click="destroy(postItm.id)" class="btn btn-outline-danger">
                      <i class="fas fa-trash"></i>
                    </a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</AppLayout></template>
