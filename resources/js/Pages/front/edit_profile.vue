<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

export default{
	components:{
		AppLayout,reactive,router
	 }
	 ,props:{
		  	  serviceCats:Object,
		  userCategories:Object,
		  departments:Object,
		  user:Object,
		  errors:Object,
	 },setup(props){
		 const form = reactive({
						first_name: props.user.first_name,
						last_name: props.user.last_name,
						email: props.user.email, 
						phone: props.user.phone,  
						biograph: props.user.biograph,  
						  
						
						imagpath:  props.user.imagpath ,
						imagpathshow:  props.user.image_path_show ,
						main_image_id: props.user.main_image_id,
						 user_categories: props.userCategories,
			}) 
			const user = props.user ;
			return { form,user }
	 }, methods:{ 
			 submit() {
				 console.log();
					 router.post('/update_profile', this.form)
			}
			
			
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
								self.form.imagpathshow =  response.data.pathshow;
								self.form.imagpath =  response.data.path;
								self.form.main_image_id = response.data.img_id;
								return true; 
					}
                )
            }
			
			
			
	 }
}
</script>

<template>
<AppLayout title="Dashboard">
  
     <!-- Main content -->
    <section class="content">
	
	 <form @submit.prevent="submit">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
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
					  <label for="name">biograph:</label>
					<textarea id="biograph" class="form-control" v-model="form.biograph"  ></textarea>
              </div>
              <div class="form-group">
					<p>{{ user.email }}</p>
              </div>
			  
			    <div class="form-group">
					<label for="phone">phone:</label>
					<input id="phone" class="form-control" v-model="form.phone" />
				  <div v-if="errors.phone">{{ errors.phone }}</div>
              </div>
			  
            
			 
			      <div class="form-group">
             			  <label for="password">salary:</label>
						<input id="password" class="form-control" v-model="form.salary" type="salary" />
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
			  
		 <div class="row">
        <div class="col-12">
          <a href="#" class="btn btn-secondary">Cancel</a>
      
		  <button @click="submit()"  class="btn btn-success float-right" type="submit">Submit</button>
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

 