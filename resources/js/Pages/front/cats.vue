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
	  
	
	
	 }
}
</script>

<template>
<AppLayout title="Dashboard">
    <div class="card-deck mb-3 text-center">
	<div class="col-md-12">
			<h2>Services Taxanomy</h2>
	</div>
      <div class="row">
			  <div class="col-md-6"  v-for="serviceCatItm in  serviceCats ">
						  
								<h2>{{ serviceCatItm.name }}</h2>
								<ul style="margin-left:20px;">
								  <li  v-for="childernItm in  serviceCatItm.chidern">
										 
										<label>{{ childernItm.title }}</label>
									
								  </li>
								</ul>
						  </div>
	  </div>
	</div>
  </AppLayout>
</template>

 