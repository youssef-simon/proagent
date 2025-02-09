  <script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import Multiselect from '@vueform/multiselect'
import SideMenu from '@/Pages/front/Comp/SideMenu.vue';

export default{
	components:{
		AppLayout,reactive,router,Multiselect,SideMenu
	 }
	  ,
	   data() {
					return {
						submit_form:false   
				   
					}
		  } 
	 
	 ,props:{
			user:Object,
			serviceCategories:Object,
			errors:Object
	 },setup(){
		 const form = reactive({
		 
				title: '', 
				description: '', 
				price_from: '', 
				 imgfields: [],
				 	imagpath: null,
                main_image_id: null,
			})
			return { form }
	 }, methods:{
	 
	 submit() {
		   router.post('/store_work', this.form, {
															onProgress: () => (this.submit_form=true),
															  onError: () =>(this.submit_form=false),
						});
		}
		,async searhCompanies(query){
					  const response = await fetch('/searchusers?term=' + query);
					  const dataa = await response.json();; // Here you have the data that you need
	 
					  return dataa.data.map((item) => {
						return { value: item.id, label: item.full_name }
					  });
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
	
     <h2>Add Previos Project / Experince / Achievement</h2>
			  
			   
 
 
 
 	
	 <form @submit.prevent="submit">
      <div class="col-md-9">
      
            <div class="formCont">
              <div class="form-group">
					  <label for="title">title</label>
				 	  <input id="title" class="form-control" v-model="form.title" />
					 <div class="error_val" v-if="errors.title">{{ errors.title }}</div>
			   </div>
			   
			   
			    
              <div class="form-group">
					  <label for="description">description</label>
				 	  <textarea id="description" class="form-control" v-model="form.description"></textarea>
					 <div class="error_val" v-if="errors.description">description</div>
			   </div>
			   
			    
			   
			   
			 
			   
			   
				
				 
					
					
					
					
					 <div class="repeater col-md-12 p15">
                        <h3>Main Image</h3>
									<p class="descPhoto">Max 2MB</p>
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="control-group w-100 imgUploadCont">
                                     <label for="file-input">
									 <i class="fa fa-image"></i>
									Upload Image
									  
									 
									 </label>
                                    <input type="file" class="imgfile" accept="image/*" @change="uploadImage($event,index)" id="file-input">
                                  
                                    <img :src="form.imagpathshow" />
                                </div>
                            </div>
                        </div>  
                    </div>

			  
			  

				
				
				
				          <div class="repeater col-md-12 p15">
                        <h3>Other Images</h3>
                        <div class="borders" v-for="(field, index) in form.imgfields">
                            <div class="row">
                                <div class="col-md-12" >
                                    <div class="control-group w-100 imgUploadCont">
                                           <label :for="'mfile-input'+index"> 
										   <i class="fa fa-image"></i>
													Upload Image
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

 