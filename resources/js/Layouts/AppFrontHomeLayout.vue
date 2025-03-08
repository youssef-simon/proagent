<script>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { usePage } from '@inertiajs/vue3';

 export default {
  data() {
    return {
      user: usePage().props.auth.user, 
	      notifications_count: usePage().props.notifications, 
      msg_count: usePage().props.msg, 
      
    }
  },
  methods: {
    showTree(id) {
		 
				
				
				
				
	 
    } 
	,
	 isCurrentPath(path) {
		 // console.log(router.page.url);
		 //   const route=useRoute();
			return router.page.url === path;
    }
  },created(){
	  //const page = usePage();
  }
}
</script>

<template>
 
<div class="wrapper frontPage">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="/"><img src="/img/logo.png" style="width:55px;" />
		 
		</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

	  <ul class="navbar-collapse userMenu">
				<template v-if="user">
						<li class="nav-item">
									<a style="position:relative;" class="nav-link" href="/my_messages">
											  <i class="fa fa-envelope"></i> 
											  <template v-if="msg_count">
													  <span class="notCount">{{ msg_count }}</span>
													  </template>
									</a>           
						</li>
						 <li class="nav-item">
								<a style="position:relative;" class="nav-link" href="">
													  <i class="fa fa-bell"></i>
													  
													    <template v-if="notifications_count">
													  <span class="notCount">{{ notifications_count }}</span>
													  </template>
									</a>
						  </li>
				</template>	  
		 </ul>	 







        <div class="navbar-collapse proNav" id="navbarsExample07">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
					<a   class="nav-link" href="/home">Home</a>
            </li>
     
            <li class="nav-item">
					<a class="nav-link" href="/users">Users</a>
            </li>
             <li class="nav-item">
					<a class="nav-link" href="/taxservice">Taxanomy</a>
            </li>
			
			
			
			
			
			<template v-if="!user" >
						<li class="nav-item">
							<a class="btn btn-outline-dark nav-link" href="/register">Sign up</a>
					   </li>
					   <li class="nav-item">
							<a class="btn btn-outline-dark nav-link" href="/user_login">Login</a>
					     </li>
					 </template>
							 <template v-if="user" >
								<li class="nav-item bgBtm">
										<a class="btn btn-dark" href="/my_dashboard">My Dashboard</a>
							     </li>
							   <li class="nav-item bgBtm">
									<a class="btn btn-dark" href="/logout_user">Log Out</a>
							    </li>
							 </template>
          </ul>
          
        </div>
      </div>
    </nav>
















 
<div class="">

		<slot />
   
   </div>
   </div>
</template>
