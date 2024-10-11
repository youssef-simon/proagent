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
 
<div class="wrapper">

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal">Company name</h5>
      <nav class="my-2 my-md-0 mr-md-3">
	  
	    <a class="p-2 text-dark" href="/home">Home</a>
        <a class="p-2 text-dark" href="/service">Services</a>
      
        <a class="p-2 text-dark" href="/users">Users</a>
        <a class="p-2 text-dark" href="/taxservice">taxanomy</a>
      </nav>
	 <template v-if="!user" >
      <a class="btn btn-outline-primary" href="/register">Sign up</a>
      <a class="btn btn-outline-primary" href="/user_login">Login</a>
     </template>
			 <template v-if="user" >
			  <a class="btn btn-outline-primary" href="/my_dashboard">my Dashboard</a>
			  <a class="btn btn-outline-primary" href="/logout_user">Log Out</a>
			 
			 </template>
	</div>
<div class="container containerBig">

		<slot />
   
   </div>
   </div>
</template>
