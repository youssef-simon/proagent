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
            <h1>services</h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="card">
	
	  <div class="card-header">
                <div>
					<a  class="btn btn-primary" :href="'/admin/service/create/'+this.id">add service</a>
			  </div>
              </div>
			  
			   
<table class="table table-bordered table-hover dataTable dtr-inline">

<tr>
	<td>ID</td>
	<td>services</td> 
	<td>status</td> 
</tr>
<tr  v-for="service in services.data">
	<td>{{ service.id }}</td>
	<td>{{ service.title }}</td> 
	<td> 
	
		<span v-if="service.status==1" >Under Review</span>
		<span v-if="service.status==2" >Approved</span>
		<span v-if="service.status==3" >declined</span>

		</td>
	<td>
	
			<Link  class="btn-primary btn"
                    :href="'/admin/service/edit/'+service.id"
                    v-html="'edit'"
                />
				
			 <Link class="btn-primary btn" @click="destroy( service.id)" >
                                                Delete
                                            </Link> 
											
				
			 <Link class="btn-primary btn"    :href="'/admin/service/view/'+service.id" >
                                                View
                                            </Link> 
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
	  
	 
  </AppLayout>
</template>

 <script>
import { Link } from '@inertiajs/vue3'

import { usePage } from '@inertiajs/vue3'
export default {
  props: {
    services: {
      type: Object,
      required: true,
    },
	id:String
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
			
	},created(){
		//const page = usePage();
		//console.log(page.props.id);
		
	}
  
};
</script>