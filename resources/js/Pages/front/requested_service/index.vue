<script setup>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3' 
import SideMenu from '@/Pages/front/Comp/SideMenu.vue';

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
							<h3>Service Requests</h3>
					  </div>
					  </div>
					  
					   
		  
			   
<table class="table table-bordered table-hover dataTable dtr-inline">

<tr>
	<td>ID</td> 
	<td>Image</td> 
	<td>name</td> 
</tr>
 <tr  v-for="request in serviceRequests.data">
	<td>{{ request.id }}</td> 
	<td><img  :src="request.service.image_path_show" style="width:250px;height:250px;" /></td> 
	<td>{{ request.service.title }}</td> 
	<td>
	
		<Link  class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary"
                   
                    :href="'/request_view/'+request.id"
                    v-html="'view'"
                />
				
			 
				</td>
</tr>


</table>
 

	  <div v-if="serviceRequests.links.length > 3">
        <div class="flex flex-wrap mt-8">
            <template v-for="(link, key) in  serviceRequests.links" :key="key">
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









 <script>
import { Link } from '@inertiajs/vue3'
export default {
  props: {
    serviceRequests: {
      type: Object,
      required: true,
    },
  },  components: {
        Link,
    },methods:{
		  destroy(id) {
				if (confirm("Are you sure you want to Delete")) {
         
					router.delete(route("service.delete", id));
				}
			},
/* 	 submit( ) {
		 
			 router.get('/availableslots/index',this.form);
	 } */
			
	}
  
};
</script>