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
				 
			  </div>
              </div>
			  		   
	 	<div class="container-fluid">
								<div class="searchForm">
										<div class="row">
											 
													<div class="form-group col-md-3">
														<label>Status</label>
															<select  v-model="form.status"  class="form-control rounded-3">
															 
															 <option value="1">STATUS_PENDING</option>
															 <option value="2">STATUS_ACCEPTED</option>
															 <option value="3">STATUS_REFUSED</option>
															 </select>
													</div>
													 
														<div class="col-md-12 form-group">
															<button class="btn btn-primary" @click="submit()">search</button> 
													</div> 
					
										</div>
							</div>
			  </div>
			   
<table class="table table-bordered table-hover dataTable dtr-inline">

<tr>
	<td>ID</td>
	<td>services</td> 
	<td>user email</td> 
</tr>
<tr  v-for="service in services.data">
	<td>{{ service.id }}</td>
	<td>{{ service.title }}</td> 
	<td>{{ service.user.email }}</td> 
	<td> 
	
		<span v-if="service.status==1" >Under Review</span>
		<span v-if="service.status==2" >Approved</span>
		<span v-if="service.status==3" >declined</span>

		</td>
	<td>
	 	 <Link class="btn-primary btn"    :href="'/admin/service/view/'+service.id" >   View     </Link> 
	 	 <Link class="btn-primary btn"    :href="'/admin/service/user/'+service.user.id" >   View User    </Link> 
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
 
 import AppLayout from '@/Layouts/AppLayout.vue'; 
import { router } from '@inertiajs/vue3'

import { Link } from '@inertiajs/vue3'

import { usePage } from '@inertiajs/vue3'

import { reactive } from 'vue'

export default {
  props: {
    services: {
      type: Object,
      required: true,
    },
	id:String
  },  components: {
        Link,AppLayout
    }
	,setup(props){
		 const form = reactive({
				status:props.status,  
			})
			return { form }
	 }
	,methods:{
		  destroy(id) {
				if (confirm("Are you sure you want to Delete")) {
         
					router.delete(route("service.delete", id));
				}
			},
  	 submit( ) {
		 
			 router.get('/admin/service/index',this.form);
	 } 
			
	},created(){
		//const page = usePage();
		//console.log(page.props.id);
		
	}
  
};
</script>