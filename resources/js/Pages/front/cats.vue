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
		 
	 }, methods:{
	  
	
	
	 }
}
</script>

<template>
<AppLayout title="Dashboard">
    <div class="container whContAll taxaPage">
	<div class="colHeader">
			<h2>Taxanomy</h2>
	</div>
      <div class="row">
	  
			  <div class="col-md-4 taxItmCont"  v-for="(serviceCatItm, index) in  serviceCats ">
						  
								<h6>
								<a :href="'/service_all/'+serviceCatItm.id">
										{{ serviceCatItm.name }}
									 
								</a>
								</h6>
								<ul style="margin-left:20px;">
								  <li  v-for="childernItm in  serviceCatItm.chidern">
										 <a :href="'/service_all/'+index+'/'+childernItm.id">{{ childernItm.title }}</a>
										 
									
								  </li>
								</ul>
						  </div>
	  </div>
	</div>
  </AppLayout>
</template>

 