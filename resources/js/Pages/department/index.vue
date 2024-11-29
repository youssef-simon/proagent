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
            <h1>department</h1>
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
                <h3 class="card-title">department</h3>
              </div>
			  
			  
			    <div>
					<a href="/department/create">add department</a>
			  </div>
			  
				<table class="table table-bordered table-hover dataTable dtr-inline">
							<tr>
								<td>ID</td>
								<td>Departement Name</td>
								<td>Employee Count</td>
								<td>salary</td>
							</tr>
						<tr  v-for="department in departments.data">
									<td>{{ department.id }}</td>
									<td>{{ department.name  }}</td> 
									<td>{{ department.user_count  }}</td> 
									<td>{{ department.salary  }}</td> 
									<td> 
									
											<template v-if="department.user_count==0">
											 <Link  class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-blue focus:border-primary focus:text-primary" @click="destroy(product.id)" > Delete </Link> 
											</template>
											 
											 <Link class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary" :href="'/department/edit/'+department.id" v-html="'edit'" /> 
								
								</td>
						</tr>
				</table>


 

	  <div v-if=" departments.links.length > 3">
        <div class="flex flex-wrap mt-8">
            <template v-for="(link, key) in  departments.links" :key="key">
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
    departments: {
      type: Object,
      required: true,
    },
  },  components: {
        Link,
    },methods:{
		  destroy(id) {
				if (confirm("Are you sure you want to Delete")) {
         
					router.delete(route("department.delete", id));
				}
			},
	 submit( ) {
		 
			 router.get('/departements/index',this.form);
	 }
			
	}
  
};
</script>