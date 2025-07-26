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
            <h1> user links</h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="card">
	
	  <div class="card-header">
                <div>
					<a  class="btn btn-primary" :href="'/admin/userlink/create/'+user.id">add user link</a>
			  </div>
              </div>
			  
			   
<table class="table table-bordered table-hover dataTable dtr-inline">

<tr>
	<td>ID</td>
	<td>project</td> 
</tr>
<tr  v-for="userLink in userLinks.data">
	<td>{{ userLink.id }}</td>
	<td>{{ userLink.title }}</td> 
	<td>
	
		<Link  class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary"
                   
                    :href="'/admin/userlink/edit/'+userLink.id"
                    v-html="'edit'"
                />
				<Link  class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary"
                   
                    :href="'/admin/userlink/view/'+userLink.id"
                    v-html="'view'"
                />
			 <Link class="btn-primary btn" @click="destroy( userLink.id)" >
                                                Delete
                                            </Link> 
				</td>
</tr>
</table>
 

	  <div v-if="userLinks.links.length > 3">
        <div class="flex flex-wrap mt-8">
            <template v-for="(link, key) in  userLinks.links" :key="key">
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
	  user: {
      type: Object,
      required: true,
    },
    userLinks: {
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