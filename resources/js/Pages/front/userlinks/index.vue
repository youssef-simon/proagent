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
		 userLinks: {
			  type: Object,
			  required: true,
			},
	 },setup(){
		 
	 }, methods:{
	  destroy(id) {
				if (confirm("Are you sure you want to Delete")) {
         
					router.delete(route("delete_work_front", id));
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






    <div class="card myListMenu">
	
	  <div class="card-header">
                <div>
					<a  class="btn btn-primary" href="/link/create">Link Create</a>
			  </div>
              </div>
			  
			   
<table class="table table-bordered table-hover dataTable dtr-inline">

<tr>
	<th>ID</th>
	<th>Title</th> 
 
	<th>Status</th> 
	<th> </th>  
	 
	 
</tr>
<tr  v-for="userLink in userLinks.data">
	<td>{{ userLink.id }}</td>
	<td><a href="">{{ userLink.title }}</a></td> 
	<td>{{ userLink.description }}</td> 
 
 
 
	
	<td> 
		<span class="badge badge-warning" v-if="userLink.status==1" >Under Review</span>
		<span  class="badge badge-success"  v-if="userLink.status==2" >Approved</span>
		<span class="badge badge-danger"  v-if="userLink.status==3" >declined</span>

				<template v-if="userLink.status==3">
					<Link  class="btn-primary btn"
									 :href="'/link/edit/'+userProject.id"
									v-html="'view reason'"
								/> 
				</template>
				
				</td>
	<td class="actionBtn">
	
		<Link  class="btn-primary btn"
                     :href="'/link/edit/'+userLink.id"
                    v-html="'edit'"
                />
				
			 <Link class="btn-primary btn" @click="destroy( userLink.id)" >
                                                Delete
                                            </Link> 
			

		<Link  class="btn-primary btn"
                     :href="'/work_view/'+userLink.id"
                    v-html="'View'"
                />
							
											
											
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
	  
	










		</div>
	</div>  
	</div>  
  </AppLayout>
</template>

 