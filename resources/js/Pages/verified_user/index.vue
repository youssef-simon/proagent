<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'; 
import { router } from '@inertiajs/vue3'
</script>

     
<template>
<AppLayout title="Dashboard">
      <section class="content-header">
			  <div class="container-fluid">
				<div class="row mb-2">
				  <div class="col-sm-6">
					<h1>Verified Users</h1>
				  </div>
				 
				</div>
			  </div> 
     </section>

    <div class="card">
	
	  <div class="card-header">
                <h3 class="card-title">Verified users</h3>
              </div>
			  
			
<table class="table table-bordered table-hover dataTable dtr-inline">
							<tr>
								<td>ID</td>
								<td> </td>
								
							</tr>
<tr  v-for="verifiedRequest in verifiedRequests.data">
	<td>{{ verifiedRequest.id }}</td>
 
	<td>
	<Link  class="btn btn-primary"
                    :href="'/admin/verify_user_view/'+verifiedRequest.id"
                    v-html="'view projects'"
                />		 
				</td>
</tr>
</table>
 

	  <div v-if="verifiedRequests.links.length > 3">
        <div class="flex flex-wrap mt-8">
            <template v-for="(link, key) in  verifiedRequests.links" :key="key">
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
	  
	 
  </AppLayout>
</template>

 <script>
import { Link } from '@inertiajs/vue3'
export default {
  props: {
    verifiedRequests: {
      type: Object,
      required: true,
    },
  },  components: {
        Link,
    },methods:{
		  destroy(id) {
				if (confirm("Are you sure you want to Delete")) {
         
					router.delete(route("user.delete", id));
				}
			},
/* 	 submit( ) {
		 
			 router.get('/availableslots/index',this.form);
	 } */
			
	}
  
};
</script>