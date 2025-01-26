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
		 userProjects: {
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






    <div class="card">
	
	  <div class="card-header">
                <div>
					<a  class="btn btn-primary" href="/create_work">add works</a>
			  </div>
              </div>
			  
			   
<table class="table table-bordered table-hover dataTable dtr-inline">

<tr>
	<td>ID</td>
	<td>Title</td> 
	 
	 
</tr>
<tr  v-for="userProject in userProjects.data">
	<td>{{ userProject.id }}</td>
	<td>{{ userProject.title }}</td> 
 
 
	<td><img :src="userProject.image_path_show" style="width:150px;height:150px;" /></td> 
	<td>
	
		<Link  class="btn-primary btn"
                     :href="'/edit_work/'+userProject.id"
                    v-html="'edit'"
                />
				
			 <Link class="btn-primary btn" @click="destroy( userProject.id)" >
                                                Delete
                                            </Link> 
			

		<Link  class="btn-primary btn"
                     :href="'/work_view/'+userProject.id"
                    v-html="'View'"
                />
							
											
											
				</td>
</tr>
</table>
 

	  <div v-if="userProjects.links.length > 3">
        <div class="flex flex-wrap mt-8">
            <template v-for="(link, key) in  userProjects.links" :key="key">
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

 