   
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
						submit_form:false,   
						serviceCategories:[]
					}
		  } 
	 
	 ,props:{
		//	serviceCategories:Object,
			departments:Object,
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
		   router.post('/add_service', this.form, {
															onProgress: () => (this.submit_form=true),
															  onError: () =>(this.submit_form=false),
						});
		}
		,departmentChange(){
		
		 
		  var self = this;
				   axios.get("/changedepart/"+ this.form.department_id)
					  .then( function(response) {
											const getData =response.data.data;
											 
											self.serviceCategories = getData;
											 
									}
							)
					  .catch(error => {
						console.error(error);
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
                    console.log(self.form.imgfields[index].img);
						//let result = response.data.path.replace("public", "storage");
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
					 <div class="card">
							
						 
					  
					   	
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
				 	  <textarea id="description" class="form-control" v-model="form.description"></textarea>
					 <div class="error_val" v-if="errors.description">{{ errors.description }}</div>
			   </div>
			   
			     <div class="form-group">
					  <label for="price_from">price_from</label>
				 	  <input id="price_from" class="form-control" v-model="form.price_from" />
					<div class="error_val" v-if="errors.price_from">{{ errors.price_from }}</div>
			   </div>
			   
			   
			   
			     <div class="form-group">
										<label for="department_id">departement</label>
											<select   @change="departmentChange" class="form-control" v-model="form.department_id">
												 <option v-for="departmentItm in departments"  
														 :value="departmentItm.id">
														 {{ departmentItm.name }}
												 </option> 
											</select>
										<div class="error_val" v-if="errors.department_id">{{ errors.department_id }}</div>
				</div>
			   
			    <div class="form-group">
										<label for="category_id">category</label>
											<select   class="form-control" v-model="form.category_id">
												 <option v-for="serviceCategory in serviceCategories"  
														 :value="serviceCategory.id">
														 {{ serviceCategory.title }}
												 </option> 
											</select>
										<div class="error_val" v-if="errors.category_id">{{ errors.category_id }}</div>
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

 
		 

		 
			</div>
			  
				</div>
			</div>  
	</div> 



	
  </AppLayout>
</template>

 