<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

export default{
	components:{
		AppLayout,reactive,router
	 }
	   ,
	   data() {
					return {
						submit_form:false   
				   
					}
		  } 
	  
	 ,props:{
		//  departments:Object,
		  serviceCats:Object,
		  errors:Object,
	 },setup(){
		 const form = reactive({
				first_name: '',
				lsst_name: '',
				email: '',
				password: '',
				phone: '',
				password_confirmation: '',
				imagpath: null,
                main_image_id: null,
                user_categories: [],
				
			 
			})
			return { form }
	 }, methods:{
	 
	 submit() {
		 console.log();
			 router.post('/user/store', this.form)
	}
	,departmentChange(){
		 
	}
	,   uploadImage(event, index) {
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
	
	
	
	
	
	
	 }
}
</script>

<template>
<AppLayout title="Dashboard">
       <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
           
        </div>
      </div> 
    </section>
     <!-- Main content -->
    <section class="content">
	
	 <form @submit.prevent="submit">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            
            <div class="card-body">
              <div class="form-group">
					  <label for="name">  first_name:</label>
					<input id="first_name" class="form-control" v-model="form.first_name" />
              </div>
			  <div class="form-group">
					  <label for="name">  last_name:</label>
					<input id="last_name" class="form-control" v-model="form.last_name" />
              </div>
              <div class="form-group">
					<label for="email">email:</label>
					<input id="email" class="form-control" v-model="form.email" />
				  <div v-if="errors.email">{{ errors.email }}</div>
              </div>
			  
			  
			     <div class="form-group">
					<label for="email">biograph:</label>
					<textarea id="biograph" class="form-control" v-model="form.biograph" ></textarea>
				  <div v-if="errors.biograph">{{ errors.biograph }}</div>
              </div>
			  
			  
			  
			  
			    <div class="form-group">
					<label for="phone">phone:</label>
					<input id="phone" class="form-control" v-model="form.phone" />
				  <div v-if="errors.phone">{{ errors.phone }}</div>
              </div>
			  
              <div class="form-group">
             			  <label for="password">password:</label>
						<input id="password" class="form-control" v-model="form.password" type="password" />
              </div>
              
              <div class="form-group">
                       <label for="password_confirmation">password_confirmation:</label>
					<input id="password_confirmation" class="form-control" type="password" v-model="form.password_confirmation" />
              </div>
			  
			 
			  
			  <div class="form-group">
			   
						  <div  v-for="serviceCatItm in  serviceCats ">
						  
								<h2>{{ serviceCatItm.name }}</h2>
								<ul style="margin-left:20px;">
								  <li  v-for="childernItm in  serviceCatItm.chidern">
										<input type="checkbox" :value="childernItm.id" v-model="form.user_categories" />
										<label>{{ childernItm.title }}</label>
									
								  </li>
								</ul>
						  </div>
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

			 
			 
			 
			 
		 <div class="row">
        <div class="col-12">
          <a href="#" class="btn btn-secondary">Cancel</a>
      
		  <button   class="btn btn-success float-right" type="submit">Submit</button>
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

 