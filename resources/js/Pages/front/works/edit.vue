<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
 
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import SideMenu from '@/Pages/front/Comp/SideMenu.vue';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default{
	components:{
		AppLayout,reactive,router,SideMenu,QuillEditor
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
				     router.post('/update_work/'+this.userproject.id, this.form)
			  }
			  
			  
			  /***************************/
		
		, uploadImage(event, index) {
                var self = this;
                // this.form.refields[index].img="Ddd";

						if(event.target.files[0].size > 3297152) {
						   alert("file should not be bigger then 3MB");
						   return false;
				 }





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



					if(event.target.files[0].size > 3297152) {
						   alert("file should not be bigger then 3MB");
						   return false;
				 }


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
			
			
			
			
			 ,AddField: function () {
                this.form.imgfields.push({
                    title: '',
                    img: '',
                    img_id: 0,

                });

            }, removeField: function (index) {
                this.form.imgfields.splice(index, 1);
            },
		/***************************/
		
		
			
			
			
			
	 }
}
</script>

<template>
<AppLayout title="Dashboard">
    <div class="whContAll">
  <div class="row">
		<div class="col-md-3">
			<SideMenu />
		</div>  
		<div class="col-md-9">

    <div class="formMainCont">
	
     <h2>{{ __("edit_prev_project") }}</h2>
			  
			   					
<div class="refusedReasonCont col-md-6">
	<p>
	{{ userproject.reason }}
	</p>
</div>	
 
 
 
 	
	 <form @submit.prevent="submit">
      <div class="col-md-9">
      
            <div class="formCont">
              <div class="form-group">
					  <label for="title">{{ __("title") }}</label>
				 	  <input id="title" class="form-control" v-model="form.title" />
					 <div class="error_val" v-if="errors.title">{{ errors.title }}</div>
			   </div>
			   
			   
			    
                
              <div class="form-group">
					<label for="description">{{ __("description") }}</label>
				 	  <QuillEditor v-model:content="form.description"  id="description" class="form-control txtEdior"  contentType="html"  theme="snow" /> 
					   
					 <div class="error_val" v-if="errors.description">{{ errors.description }}</div>
			   </div>
			    
			   
			   
			 
			   
			   
				
				 
					
					
					
					
					 <div class="repeater col-md-12 p15">
                       <h3>{{ __("main_image") }}</h3>
									<p class="descPhoto">Max 2MB</p>
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="control-group w-100 imgUploadCont">
                                     <label for="file-input">
									 <i class="fa fa-image"></i>
									 {{ __("upload_image") }}
									 
									 </label>
                                    <input type="file" class="imgfile" accept="image/*" @change="uploadImage($event,index)" id="file-input">
                                  
                                    <img :src="form.imagpathshow" />
                                </div>
                            </div>
                        </div>  
                    </div>

			  
			  

				
				
				
				          <div class="repeater col-md-12 p15">
                     <h3>{{ __("other_images") }}</h3>
                        <div class="borders" v-for="(field, index) in form.imgfields">
                            <div class="row">
                                <div class="col-md-12" >
                                    <div class="control-group w-100 imgUploadCont">
                                           <label :for="'mfile-input'+index"> 
										   <i class="fa fa-image"></i>
												 {{ __("upload_image") }}
											</label>
                                        <input type="file" class="imgfile" accept="image/*" @change="uploadMulitImage($event,index)" :id="'mfile-input'+index">
                                     
                                        <img :src="field.imagpathshow" />
                                    </div>
                                </div>
                              
                                <div class="col-md-12">
                                    <a @click="removeField(index)" href="javascript:void(0)" class="removeField btn btn-danger col-md-12"><span class="icon trash-icon"></span>
                                        Remove
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void(0)" @click="AddField" class="btn btn-dark text-white  col-md-12 addField">ADD</a>
                    </div>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
			   <div class="row">
							<div class="col-12">
								 	<button   class="btn btn-primary col-md-12" v-if="submit_form==false"	type="submit">save</button>
								<button  class="btn btn-primary col-md-12" 	 v-if="submit_form==true" type="submit" disabled>save</button>
							</div>
				</div>
            
            <!-- /.card-body -->
        
          <!-- /.card -->
        </div>
       </div>
      
	 </form> 
 
 
 
 
 
 
    </div>
	  
	
 

		</div>
	</div>  
	</div>  
  </AppLayout>
</template>

 