<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import SideMenu from '@/Pages/front/Comp/SideMenu.vue';

export default{
	components:{
		AppLayout,reactive,router,SideMenu
	 }
	 ,props:{
		 
		  user:Object,
		  errors:Object,
	 },setup(props){
		 const form = reactive({
		 
						
						imagefrontshow:  '', 
			}) 
			const user = props.user ;
			return { form,user }
	 }, methods:{ 
			 submit() {
				 console.log();
					 router.post('/update_profile', this.form)
			}
			
			
				, uploadFrontImage(event, index) {
						var self = this; 
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
										self.form.imagefrontshow =  response.data.pathshow;
										self.form.imagefrontpath =  response.data.path; 
										return true; 
							}
						)
            },uploadBackImage(event, index) {
						var self = this; 
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
										self.form.imagebackshow =  response.data.pathshow;
										self.form.imagebackpath =  response.data.path; 
										return true; 
							}
						)
            },uploadSelfImage(event, index) {
						var self = this; 
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
										self.form.imageselfshow =  response.data.pathshow;
										self.form.imageselfpath =  response.data.path; 
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
             
			  
			  
			  <div class="repeater col-md-12 p15">
                        <h3>photo for Proof of identity front</h3> 
                        <div class="row">
                            <div class="col-md-4" >
                                <div class="control-group w-100">
                                     
                                    <input type="file" accept="image/*" @change="uploadFrontImage($event,index)" id="file-input">
                                   
                                    <img :src="form.imagefrontshow" />
                                </div>
                            </div>
                        </div>  
                    </div>
					
					
					
					
			 <div class="repeater col-md-12 p15">
                        <h3>photo for Proof of identity Back</h3> 
                        <div class="row">
                            <div class="col-md-4" >
                                <div class="control-group w-100">
                                     
                                    <input type="file" accept="image/*" @change="uploadBackImage($event,index)" id="file-input">
                                  
                                    <img :src="form.imagebackshow" />
                                </div>
                            </div>
                        </div>  
                    </div>		
					
					
					
									
			 <div class="repeater col-md-12 p15">
                        <h3>selfy photo for Proof of identity with front</h3> 
                        <div class="row">
                            <div class="col-md-4" >
                                <div class="control-group w-100">
                                     
                                    <input type="file" accept="image/*" @change="uploadSelfImage($event,index)" id="file-input">
                                    
                                    <img :src="form.imageselfshow" />
                                </div>
                            </div>
                        </div>  
                    </div>	
			 
			 
			 
		 <div class="row">
        <div class="col-12">
         
      
		  <button  class="btn btn-success float-right" type="submit">Submit</button>
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

 