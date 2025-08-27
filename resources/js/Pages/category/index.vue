

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
					<a  class="btn btn-primary"   :href="route('category.create')">add user link</a>
			  </div>
              </div>
			  
			   
<table class="table table-bordered table-hover dataTable dtr-inline">

<tr>
	<td>ID</td>
	<td>project</td> 
</tr>
  <tr v-for="category in categories.data"> 
                       <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                           {{ category.title }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ category.description }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a :href="route('category.edit',category.id)" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                             <a @click="destroy(category.id)" class="text-red-600 hover:text-red-900">Delete</a>
                        </td>
                    </tr>
</table>
 

	  <div v-if="categories.links.length > 3">
        <div class="flex flex-wrap mt-8">
            <template v-for="(link, key) in  categories.links" :key="key">
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
	 			
		 categories:Object,
		 errors:Object
  },  components: {
        Link,
    },methods:{
		  destroy(id) {
				if (confirm("Are you sure you want to Delete")) {
         
					router.delete(route("category.delete", id));
				}
			},
/* 	 submit( ) {
		 
			 router.get('/availableslots/index',this.form);
	 } */
			
	}
  
};
</script>
















