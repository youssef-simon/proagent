<script>
import { Link } from '@inertiajs/vue3' 
import AppLayout from '@/Layouts/AppFrontLayout.vue'; 
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3' 
import SideMenu from '@/Pages/front/Comp/SideMenu.vue';
 
export default {
  props: {
    notificationsdata: {
      type: Object,
      required: true,
    },
  },  components: {
        Link,SideMenu,AppLayout
    },methods:{
		  destroy(id) {
				if (confirm("Are you sure you want to Delete")) {
         
					router.delete(route("service.delete", id));
				}
			},
 	 subscribe(id) {
		var form= { "id":id		 };
			 router.post('/make_subscr', form);
	 }  
			
	}
  
};
</script>
  
<template>
<AppLayout title="Dashboard">
 
	 <div class="whContAll notifyCont">
		  <div class="row">
				<div class="col-md-3">
			<SideMenu />
				</div>  
				<div class="col-md-9">
					 <div class="cards">
			<h2>Notifictions</h2>
		 
					  
		 <ul class="notifyContList">
				<template v-for="notification in notificationsdata.data">
						 
						<li v-html="notification.description">  </li>
							 
						 
				</template>	
				</ul>
		 
 
			</div>
			  
				</div>
			</div>  
	</div> 

  </AppLayout>
</template>








