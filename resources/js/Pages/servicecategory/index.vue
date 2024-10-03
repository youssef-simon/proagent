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
            <h1> المناطق</h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="card">
	
	  <div class="card-header">
                <div>
					<a  class="btn btn-primary" href="/area/create">اضف منطقة</a>
			  </div>
              </div>
			  
			   
<table class="table table-bordered table-hover dataTable dtr-inline">

<tr>
	<td>ID</td>
	<td>اسم المنطقة</td> 
</tr>
<tr  v-for="servicecategory in servicecategories.data">
	<td>{{ servicecategory.id }}</td>
	<td>{{ servicecategory.title }}</td> 
	<td>
	
		<Link  class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary"
                   
                    :href="'/service_category/edit/'+servicecategory.id"
                    v-html="'edit'"
                />
				
			 <Link class="btn-primary btn" @click="destroy( servicecategory.id)" >
                                                Delete
                                            </Link> 
				</td>
</tr>
</table>
 

	  <div v-if="servicecategories.links.length > 3">
        <div class="flex flex-wrap mt-8">
            <template v-for="(link, key) in  servicecategories.links" :key="key">
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
    servicecategories: {
      type: Object,
      required: true,
    },
  },  components: {
        Link,
    },methods:{
		  destroy(id) {
				if (confirm("Are you sure you want to Delete")) {
         
					router.delete(route("service_category.delete", id));
				}
			},
/* 	 submit( ) {
		 
			 router.get('/availableslots/index',this.form);
	 } */
			
	}
  
};
</script>