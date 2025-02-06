<script>
import AppLayout from '@/Layouts/AppFrontHomeLayout.vue';
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
				salary: '',
				department_id: 0,
				
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
<AppLayout title="">
 <section class="intro">
		<div class="container">
				<div class="headerContainer">
						<div class="headTxtCont">
						<h1>Start Your Freelancing</h1>
						<h4>Build your portfolio and Sell your Services</h4>
						<h4>Make your portfolio to show your Experince and Past Projects , your paid Services</h4>
						</div>
				</div>
		</div>
 </section>
 
  <section class="howto">
		<div class="container">
				 <h1>How It Works</h1>
				 
				 <div class="row howtoList">
					 <div class="col-md-4"> 
						<div class="itmHow">
							<h4>Register</h4>
								<img src="/img/reg.png" />
						</div>
					 </div>
					 <div class="col-md-4"> 
						<div class="itmHow">
							<h4>Validation</h4>
								<img src="/img/val.png" />
						</div>
					 </div>
					 <div class="col-md-4"> 
							<div class="itmHow">
							<h4>Build your cv</h4>
							
								<img src="/img/cv.png" />
						</div>				
					 </div>
					 
					 	 <div class="col-md-4"> 
						<div class="itmHow">
							<h4>Add your Past Projects</h4>
							<img src="/img/p.png" />
						</div>
					 </div>
					 <div class="col-md-4"> 
						<div class="itmHow">
						 <h4>Add your Past Services</h4>
						 <img src="/img/s.png" />
						</div>
					 </div>
					 <div class="col-md-4"> 
							<div class="itmHow">
								 <h4>Get Customer</h4>
								  <img src="/img/m.png" />
						</div>				
					 </div>
					 
				 </div>
		</div>
 </section>
  </AppLayout>
</template>

 