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
            <h1>Admins</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gallery</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="card">
	
	  <div class="card-header">
                <h3 class="card-title">admins</h3>
              </div>
			  
			    <div>
					<a href="/admin/create">add admins</a>
			  </div>
<table class="table table-bordered table-hover dataTable dtr-inline">

<tr>
	<td>ID</td>
	<td>Full Name</td> 
</tr>
<tr  v-for="admin in admins.data">
	<td>{{ admin.id }}</td>
	<td>{{ admin.full_name }}</td> 
	<td><Link
                   
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary"
                   
                    :href="'/admin/edit/'+admin.id"
                    v-html="'edit'"
                />
				
				
				 <Link
                                                class="btn-primary btn"
                                                @click="destroy( admin.id)"
                                            >
                                                Delete
                                            </Link> 
				</td>
</tr>
</table>
 

	  <div v-if="admins.links.length > 3">
        <div class="flex flex-wrap mt-8">
            <template v-for="(link, key) in  admins.links" :key="key">
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
    admins: {
      type: Object,
      required: true,
    },
  },  components: {
        Link,
    },methods:{
		  destroy(id) {
				if (confirm("Are you sure you want to Delete")) {
         
					router.delete(route("admin.delete", id));
				}
			},
/* 	 submit( ) {
		 
			 router.get('/availableslots/index',this.form);
	 } */
			
	}
  
};
</script>