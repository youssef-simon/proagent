<script setup>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3' 
import SideMenu from '@/Pages/front/Comp/SideMenu.vue';

</script>

  
<template>
<AppLayout title="Dashboard">
    <div class="whContAll">
		<div class="row"> 
				<template v-for="subscriptionItm in subscriptions">
						<div class="col-md-4">
						
						 
							<h6>{{ subscriptionItm.title }}</h6>
					
							<h6>Service Limit : {{ subscriptionItm.service_limit }}</h6>
							<h6>Prev Work :{{ subscriptionItm.work_limit }}</h6>
							<h6>Max Image Number : {{ subscriptionItm.max_img }}</h6>
							<h6>Price : {{ subscriptionItm.price }}</h6>
							<h6>Period : {{ subscriptionItm.period_month }}</h6>
						<p><a href="javascript::void(0)" class="btn btn-primary" @click="subscribe(subscriptionItm.id)">Subscribe</a></p>
						</div>
				</template>	
		</div> 
	</div> 



	
  </AppLayout>
</template>









 <script>
import { Link } from '@inertiajs/vue3'
export default {
  props: {
    subscriptions: {
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
 	 subscribe(id) {
		var form= { "id":id		 };
			 router.post('/make_subscr', form);
	 }  
			
	}
  
};
</script>