<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import SideMenu from '@/Pages/front/Comp/SideMenu.vue';



import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';


export default{
	components:{
		AppLayout,reactive,router,SideMenu,QuillEditor
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
						work_title: props.user.work_title,
						small_bio: props.user.small_bio,
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
  
  
  
  
  
  
  
  
  
  
  
      <div class="whContAll">
		  <div class="row">
				<div class="col-md-3">
			<SideMenu />
				</div>  
				<div class="col-md-9">
					 <div class="card">
			
			 
			
			
			
			
			
     <!-- Main content -->
    <div class="content">
	
	 <form @submit.prevent="submit">
      <div class="row">
        <div class="col-md-12">
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
					  <label for="name">  work_title:</label>
					<input id="work_title" class="form-control" v-model="form.work_title" />
              </div>
			  
			 <div class="form-group">
					  <label for="name">small_bio:</label>
					<textarea id="small_bio" class="form-control" v-model="form.small_bio"  ></textarea>
              </div>
			  
			    <div class="form-group">
					  <label for="name">biograph:</label>
				 
						  <QuillEditor v-model:content="form.biograph"  id="biograph" class="form-control txtEdior"  contentType="html"  theme="snow" /> 
					   
              </div>
              <div class="form-group">
					<p>{{ user.email }}</p>
              </div>
			  
			    <div class="form-group">
					<label for="phone">phone:</label>
					<input id="phone" class="form-control" v-model="form.phone" />
				  <div v-if="errors.phone">{{ errors.phone }}</div>
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
    </div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
					</div>
			   </div>
			</div>  
	</div> 
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
   
  </AppLayout>
</template>

 