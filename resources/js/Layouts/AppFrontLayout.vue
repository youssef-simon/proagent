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
      showMobileNav:0, 
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
    },showMobileMenu(){
		// alert("F");
	
		if(	this.showMobileNav==1 ){
			
				this.showMobileNav=0;
		}else {
			
				this.showMobileNav=1;
		}
	}
  },created(){
	  //const page = usePage();
	  console.log("this.notifications");
	  console.log(this.notifications);
	  //console.log(this.notifications.length);
	  console.log("this.notifications");
	  
  }
}
</script>

<template>
 
<div class="wrapper">

 

<nav class="navbar navbar-expand-lg navbar-light bg-light deskTopNav">
      <div class="container">
        <a class="navbar-brand" href="/"><img src="/img/logo.jpg" style="height:70px;" />
		 
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
								<a style="position:relative;" class="nav-link" href="/my_notifications">
													  <i class="fa fa-bell"></i>
													  <template v-if="notifications_count">
													  <span class="notCount">{{ notifications_count }}</span>
													  </template>
									</a>
						  </li>
				</template>	  
		 </ul>	 







        <div class="navbar-collapse proNav">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item"   :class="{ 'active': isCurrentPath('/home') }" >
              <a class="nav-link" href="/home">{{ __("home") }}</a>
            </li>
            <!--  <li class="nav-item">
              <a class="nav-link"  href="/service">Services</a>
            </li>-->
            <li class="nav-item" :class="{ 'active': isCurrentPath('/users') }">
              <a class="nav-link" href="/users">{{ __("freelancers") }}</a>
            </li>
             <li class="nav-item" :class="{ 'active': isCurrentPath('/taxservice') }">
              <a class="nav-link" href="/taxservice"> {{ __("taxanomy") }}</a>
            </li>
			
			<li class="nav-item" :class="{ 'active': isCurrentPath('/forums') }">
				<a class="nav-link" href="/forums">{{ __("forums") }}</a>
            </li>
			
			
			
			
			<template v-if="!user" >
						<li class="nav-item">
							<a class="btn btn-outline-dark nav-link" href="/register">{{ __("register") }}</a>
					   </li>
					   <li class="nav-item">
							<a class="btn btn-outline-dark nav-link" href="/user_login">{{ __("login") }}</a>
					     </li>
					 </template>
							 <template v-if="user" >
								<li class="nav-item bgBtm">
										<a class="btn btn-dark" href="/my_dashboard">{{ __("my_dashboard") }}</a>
							     </li>
							   <li class="nav-item bgBtm">
									<a class="btn btn-dark" href="/logout_user">{{ __("logout") }}</a>
							    </li>
							 </template>
          </ul>
          
        </div>
		
		
		
		
		
      </div>
    </nav>




<nav class="navbar navbar-expand-lg navbar-light bg-light mobileTopNav">
      <div class="container">
        <a class="navbar-brand" href="/"><img src="/img/logo.jpg" style="height:70px;" />
		 
		</a>
        <a class="navbar-toggler" href="javascript::void(0)" @click="showMobileMenu" >
          <span class="navbar-toggler-icon"></span>
        </a>
		
	<div class="mobileMenu" v-if="showMobileNav==1">
	 







        <div class="navbar-collapse proNav" >
          <ul class="navbar-nav mr-auto">
				<template v-if="user">
						<li class="nav-item">
									<a style="position:relative;" class="nav-link" href="/my_messages">
											  <i class="fa fa-envelope"></i> 
											   <template v-if="msg_count">
													  <span class="notCount">{{ msg_count }}</span>
													My Messages
													  </template>
									</a>           
						</li>
						 <li class="nav-item">
								<a style="position:relative;" class="nav-link" href="/my_notifications">
													  <i class="fa fa-bell"></i>
													  <template v-if="notifications_count">
													  <span class="notCount">{{ notifications_count }}</span>
													  My Notifications
													  </template>
									</a>
						  </li>
				</template>	  
		  
            <li class="nav-item"   :class="{ 'active': isCurrentPath('/home') }" >
              <a class="nav-link" href="/home">Home</a>
            </li>
            <!--  <li class="nav-item">
              <a class="nav-link"  href="/service">Services</a>
            </li>-->
            <li class="nav-item" :class="{ 'active': isCurrentPath('/users') }">
              <a class="nav-link" href="/users">Freelancers</a>
            </li>
             <li class="nav-item" :class="{ 'active': isCurrentPath('/taxservice') }">
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
		
		
		
		
		
      </div>
    </nav>
















 
<div class="container containerBig">

		<slot />
   
   </div>
   
   
   
   
      <div class="footerFake">
   
   </div>
   
   
   <div class="footer">
   <div class="footerCont">
   
   <span>Follow Us: </span>
   
   <ul class="social">
		<li>
		<a href="https://www.facebook.com/profile.php?id=100067640081473">
		<img src="/img/f.png" />
		</a>
		</li>
   </ul>
   </div>
   </div>
   
   
   
   
   
   
   
   
   
   </div>
</template>
