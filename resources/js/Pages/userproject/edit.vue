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
		  userproject:Object,  
		  userProjectImageArr:Object,
		  errors:Object
	 },setup(props){ 
		 const form = reactive({ 
			    title:  props.userproject.title , 
				description:  props.userproject.description ,
				
				
				imgfields:  props.userProjectImageArr ,
				imagpath:  props.userproject.imagpath ,
				imagpathshow:  props.userproject.image_path_show ,
			 })
			const userproject=props.userproject;
			return { form ,userproject }
	 }, methods:{
			  submit() {
				     router.post('/admin/userproject/update/'+this.userproject.id, this.form)
			  }
			  
			  
			  /***************************/
		
		, uploadImage(event, index) {
                var self = this;
                // this.form.refields[index].img="Ddd";

                const URL = '/api/uploadimg';

                let data = new FormData();
                data.append('name', 'my-picture');
                data.append('file', event.target.files[0]);

                let config = {
                    header: {
                        'Content-Type': 'multipart/form-data'
                    }
                };

                axios.post(URL,data,config).then(function (response) { 
								 //let result = response.data.path.replace("public", "storage");
								self.form.imagpathshow =  response.data.pathshow;
								self.form.imagpath =  response.data.path;
								self.form.main_image_id = response.data.img_id;
								return true; 
					}
                )
            }, 	   
            uploadMulitImage(event, index) {
                var self = this;
                // this.form.refields[index].img="Ddd";

                const URL = '/api/uploadimg';


                let data = new FormData();
                data.append('name', 'my-picture');
                data.append('file', event.target.files[0]);

                let config = {
                    header: {
                        'Content-Type': 'multipart/form-data'
                    }
                };

                axios.post(
                        URL,
                        data,
                        config
                        ).then(function (response) {
								self.form.imgfields[index].path =  response.data.path;
								self.form.imgfields[index].imagpathshow =  response.data.pathshow;
							 
								self.form.imgfields[index].img_id = response.data.img_id;
								return true;

                }
                )
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
            <h1>تعديل المنطقة</h1>
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
					  <label for="description">description</label> 
					  
					     <QuillEditor v-model:content="form.description"  id="description" class="form-control txtEdior"  contentType="html"  theme="snow" /> 
					   
					 <div class="error_val" v-if="errors.description">description</div>
			   </div>
			    
			   
			    
				
				
				
				
				
				 <div class="repeater col-md-12 p15">
                        <h3>photo</h3> 
                        <div class="row">
                            <div class="col-md-4" >
                                <div class="control-group w-100">
                                     
                                    <input type="file" accept="image/*" @change="uploadImage($event,index)" id="file-input">
                                    <input type="hidden"     v-model="form.img_id"  >
                                    <img :src="form.imagpathshow" />
                                </div>
                            </div>
                        </div>  
                    </div>
		 
            <div class="repeater col-md-12 p15">
                            <h3>photos</h3>
                        <div class="border" v-for="(field, index) in form.imgfields">
                            <div class="row">
                                <div class="col-md-4" >
                                    <div class="control-group w-100">
                                        <input type="file" accept="image/*" @change="uploadMulitImage($event,index)" id="file-input">
                                        <input type="hidden"     v-model="field.img_id"  >
                                        <img :src="field.imagpathshow" />
                                    </div>
                                </div>
                              
                                <div class="col-md-1">
                                    <a @click="removeField(index)" href="javascript:void(0)" class="removeField btn btn-danger"><span class="icon trash-icon"></span>
                                        remove
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void(0)" @click="AddField" class="btn btn-dark text-white">Add</a>
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

 