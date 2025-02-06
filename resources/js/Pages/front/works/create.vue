<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import Multiselect from '@vueform/multiselect'


export default{
	components:{
		AppLayout,reactive,router,Multiselect
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
       <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Previos Project / Experince / Achievement</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
     <!-- Main content -->
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
				 	  <textarea id="description" class="form-control" v-model="form.description"></textarea>
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
    <!-- /.content -->
  </AppLayout>
</template>

 