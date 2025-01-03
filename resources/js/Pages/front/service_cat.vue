<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue'; 
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

export default{
	components:{
		AppLayout,reactive,router
	 }
	,data() {
					return {
						submit_form:false   
				   
					}
		  } 
	  
	 ,props:{
		  curr_id:String,
		 dep_id:String,
		 	 department:Object,
		  services:Object,
		  categories:Object,
		  		 alldepartments:Object,
		  errors:Object,
	 },setup(props){
		 const form = reactive({
				curr_id: props.curr_id, 
			})
			return { form }
	 }, methods:{ 
	
	 }
}
</script>

<template>
<AppLayout title="Dashboard">
    <div class="whContAll">
	 
		<div class="header">
			<h2> <a :href="'/service_all/'+dep_id">{{ department.name }}</a></h2>
	</div> 
      <div class="row">
		  <div class="col-md-3">
			<ul>
				  <li class="taxItmCont"   v-for="categoryItm in categories">
						<h6>
							<a v-if="categoryItm.id==form.curr_id"  class="active"  :href="'/service_all/'+dep_id+'/'+categoryItm.id">{{ categoryItm.title }}</a>
							<a  v-if="categoryItm.id!=form.curr_id" :href="'/service_all/'+dep_id+'/'+categoryItm.id">{{ categoryItm.title }}</a>
						
						</h6>
							<ul>
								<li v-for="categoryItmChild in categoryItm.child_categories">
										<a v-if="categoryItmChild.id==form.curr_id" class="active" :href="'/service_all/'+dep_id+'/'+categoryItmChild.id">{{ categoryItmChild.title }}</a>
										<a v-if="categoryItmChild.id!=form.curr_id" :href="'/service_all/'+dep_id+'/'+categoryItmChild.id">{{ categoryItmChild.title }}</a>
								 </li>
							</ul>
				   </li>
				  </ul>
				  
				  
				  
				  
				  	<h2 v-for="departItm in alldepartments">
										<a :href="'/service_all/'+departItm.id">{{ departItm.name }}</a>
								 </h2>
							 
				  
				  
				  
		  </div>
	  <div class="col-md-9">
	  <div class="row">
			<div   v-for="serviceItm in services.data" class="col-md-4">
			
						<div class="serItm">
								 <div class="imgContainer">
								 
									<a :href="'/service_view/'+serviceItm.id">
											<img :src="serviceItm.image_path_show" style="width:100%;height:185px;" /> 
									 </a>
								 </div>
								<h6>{{ serviceItm.title }}</h6> 
								<h6>{{ serviceItm.price_from }} $</h6>
								
								<h6 class="catItm"><template v-if="serviceItm.category.parent_category">{{ serviceItm.category.parent_category.title }} /</template> {{ serviceItm.category.title }}  </h6>
							
						</div>
			</div>
			</div>
	  </div>
	</div>
	</div>
  </AppLayout>
</template>

 