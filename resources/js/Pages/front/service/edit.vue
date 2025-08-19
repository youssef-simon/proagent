<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

import SideMenu from '@/Pages/front/Comp/SideMenu.vue';
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
		    service:Object, 
		  	serviceCategories:Object,
		  	serviceImageArr:Object,
		  	departments:Object,
		  errors:Object
	 },setup(props){ 
		 const form = reactive({ 
			    title:  props.service.title , 
				description:  props.service.description ,
				price_from:  props.service.price_from ,
				category_id:  props.service.category_id ,
				imgfields:  props.serviceImageArr ,
				imagpath:  props.service.imagpath ,
				imagpathshow:  props.service.image_path_show ,
				 department_id:  props.service.department_id ,
				 serviceCategories:  props.serviceCategories ,
			 })
			const service=props.service;
			return { form ,service }
	 }, methods:{
			  submit() {
				     router.post('/service_update/'+this.service.id, this.form)
			  }
			  
			  
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
						//		 let result = response.data.path.replace("public", "storage");
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
                    console.log(self.form.imgfields[index].img);
						let result = response.data.path.replace("public", "storage");
						
                         self.form.imgfields[index].path =  response.data.path;
                    self.form.imgfields[index].imagpathshow =  response.data.pathshow;
                    self.form.imgfields[index].img_id = response.data.img_id;
                    return true;

                }
                )
            } ,departmentChange(){
					var self = this;
				   axios.get("/changedepart/"+ this.form.department_id)
					  .then( function(response) {
											const getData =response.data.data;
							
											self.form.serviceCategories = getData;
											 					console.log(self.form.serviceCategories);
									}
							)
					  .catch(error => {
						console.error(error);
					  });
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
		
		
	 },created(){
		 	  var self = this;
				   axios.get("/changedepart/"+ this.form.department_id)
					  .then( function(response) {
											const getData =response.data.data; 
											self.form.serviceCategories = getData;
											self.form.category_id = self.service.category_id;
											 
									}
							)
					  .catch(error => {
						console.error(error);
					  });  
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
					 
			
     <h1>{{ __("edit_service") }}</h1>		  
					
<div class="refusedReasonCont col-md-6">
	<p>
	{{ service.reason }}
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
			   
			     <div class="form-group"> 
					    <label for="price_from">{{ __("price_from") }}</label>
				 	  <input id="price_from" class="form-control" v-model="form.price_from" />
					<div class="error_val" v-if="errors.price_from">{{ errors.price_from }}</div>
			   </div>
			   
			   
			   
			     <div class="form-group">
				 
					    <label for="price_from">{{ __("departement") }}</label> 
											<select   @change="departmentChange" class="form-control" v-model="form.department_id">
												 <option v-for="departmentItm in departments"  
														 :value="departmentItm.id">
														 {{ departmentItm.name }}
												 </option> 
											</select>
										<div class="error_val" v-if="errors.department_id">{{ errors.department_id }}</div>
				</div>
			   
			    <div class="form-group">
										<label for="category_id">{{ __("category") }}</label>
											<select   class="form-control" v-model="form.category_id">
												 <option v-for="serviceCategory in form.serviceCategories"  
														 :value="serviceCategory.id">
														 {{ serviceCategory.title }}
												 </option> 
											</select>
										<div class="error_val" v-if="errors.category_id">{{ errors.category_id }}</div>
				</div>
			   
			     
				
			 	 <div class="repeater col-md-12 p15">
                         <h3>{{ __("main_image") }}</h3>
					<p class="descPhoto">Max 3MB / preferable aspcec ratio 1352*740</p>
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
                                        {{ __("remove") }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void(0)" @click="AddField" class="btn btn-dark text-white  col-md-12 addField">{{ __("add") }}</a>
                    </div>
				
				
			   <div class="row">
							<div class="col-12">
								 	<button   class="btn btn-primary col-md-12" v-if="submit_form==false"	type="submit">{{ __("save") }}</button>
								<button  class="btn btn-primary  col-md-12" 	 v-if="submit_form==true" type="submit" disabled>{{ __("save") }}</button>
							</div>
				</div>
				</div>
           
          <!-- /.card -->
       
       </div>
      
	 </form> 

 
		 

		  
				</div>
				</div>
			</div>  
	</div> 



	
  </AppLayout>
</template>

 