 <script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
import SideMenu from '@/Pages/front/Comp/SideMenu.vue';
 
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3'


export default{
	components:{
		AppLayout,reactive,router,Link,SideMenu
	 }
	   ,
	   data() {
					return {
						submit_form:false   ,
				   user: usePage().props.auth.user, 
					}
		  } 
	  
	 ,props:{ 
		 services: {
      type: Object,
      required: true,
    },
	 },setup(){
		 
	 }, methods:{
	  destroy(id) {
				if (confirm("Are you sure you want to Delete")) {
         
					router.delete(route("service_front.delete", id));
				}
	  
	
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
			
			  <div class="card-header">
						<div>
							<a  class="btn btn-primary" href="/create_service">add service</a>
					  </div>
					  </div>
					  
					   
		<table class="table table-bordered table-hover dataTable dtr-inline">

		<tr>
			<td>ID</td>
			<td>Services</td>  
			<td>Price</td> 
			<td>Image</td> 
			<td>Status</td> 
			<td>Reason</td> 
			<td>Acion</td> 
		</tr>
		<tr  v-for="service in services.data">
					<td>{{ service.id }}</td>
					<td>{{ service.title }}</td>  
					<td>{{ service.price_from }}</td> 
					<td><img :src="service.image_path_show" style="width:150px;height:150px;" /></td> 
				<td> 
		<span class="badge badge-warning" v-if="service.status==1" >Under Review</span>
		<span  class="badge badge-success"  v-if="service.status==2" >Approved</span>
		<span class="badge badge-danger"  v-if="service.status==3" >declined</span>

				</td>
				<td>
				{{ service.reason }}
				</td>
			<td>
			
				<Link  class="btn-primary btn"
							  :href="'/service_edit/'+service.id"
							v-html="'edit'"
						/>
						
					 <Link class="btn-primary btn" @click="destroy( service.id)" >
														Delete
													</Link> 
						
						
						 <Link class="btn-primary btn"     :href="'/service_view/'+service.id"
							v-html="'View'" />
					 </td>
					 
		</tr>
		</table>
		 

			  <div v-if="services.links.length > 3">
				<div class="flex flex-wrap mt-8">
					<template v-for="(link, key) in  services.links" :key="key">
						<div
							v-if="link.url === null"
							class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
							v-html="link.label"
						/>

						<Link
							v-else
							class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary"
							:class="{ 'bg-blue-700 text-white': link.active }"
							:href="link.url"
							v-html="link.label"
						/>
					</template>
				</div>
			</div>
			</div>
			  
				</div>
			</div>  
	</div> 



	
  </AppLayout>
</template>

 