<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
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
		  services:Object,
		  departments:Object,
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
<AppLayout title="Dashboard">
    <div class="card-deck whContAll">
	
		<div class="col-md-12">
			<h2>Services</h2>
	</div>
      <div class="row">
			<div   v-for="serviceItm in services" class="col-md-4">
			
						 <div class="serItm">
								 <div class="imgContainer">
								 
									<a :href="'/service_view/'+serviceItm.id">
											<img :src="serviceItm.image_path_show" style="width:100%;height:350px;" /> 
									 </a>
								 </div>
								<h5>{{ serviceItm.title }}</h5> 
								<h3>{{ serviceItm.price_from }} $</h3>
							
						</div>
			</div>
	  </div>
	</div>
  </AppLayout>
</template>

 