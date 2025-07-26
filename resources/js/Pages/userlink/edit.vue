<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'


import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default{
	components:{
		AppLayout,reactive,router,QuillEditor
	 }  ,
	   data() {
					return {
						submit_form:false   
				   
					}
		  } 
	 ,props:{
		  userlink:Object,   
		  errors:Object
	 },setup(props){ 
		 const form = reactive({ 
			    title:  props.userlink.title , 
				description:  props.userlink.description ,
				
				 
			 })
			const userlink=props.userlink;
			return { form ,userlink }
	 }, methods:{
			  submit() {
				     router.post('/admin/userlink/update/'+this.userlink.id, this.form)
			  }
			  
		 
	 }
}
</script>

<template>
<AppLayout title="Dashboard">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Edit Link</h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
	
      <section class="content">
	
		 <form @submit.prevent="submit">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
          
             <div class="card-body">
              <div class="form-group">
					  <label for="title">title</label>
				 	  <input id="title" class="form-control" v-model="form.title" />
					 <div class="error_val" v-if="errors.title">{{ errors.title }}</div>
			   </div>
			   
			   <div class="form-group">
					  <label for="link">link</label>
				 	  <input id="title" class="form-control" v-model="form.link" />
					 <div class="error_val" v-if="errors.link">{{ errors.link }}</div>
			   </div>
			<div class="form-group">
					  <label for="description">description</label>
				 
					     <textarea v-model="form.description"  id="description" class="form-control  "    > </textarea>
					   
					 <div class="error_val" v-if="errors.description">description</div>
			   </div>
			   
			    
				 
			   
			   
			   
			   <div class="row">
							<div class="col-12">
								 	<button   class="btn btn-primary" v-if="submit_form==false"	type="submit">save</button>
								<button  class="btn btn-primary" 	 v-if="submit_form==true" type="submit" disabled>save</button>
							</div>
				</div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
       </div>
      
	 </form> 
    </section>

	</AppLayout>
</template>

 