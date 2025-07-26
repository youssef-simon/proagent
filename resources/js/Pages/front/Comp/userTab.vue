<script>



export default{
	 
	 props:{ 
		  user:Object, 
		  
	 },methods: {
  isActive(routeName) {
     return window.location.pathname.includes(routeName);
  }
}
	 
}
</script>

<template> 

		<div class="menuTab">
  <ul>
    <li>
      <a :href="'/user_details/'+user.slug" :class="{ active: isActive('/user_details/' + user.slug) }">
        My Details
      </a>
    </li>
    <li>
      <a :href="'/user_services/'+user.slug" :class="{ active: isActive('/user_services/' + user.slug) }">
        My Services
      </a>
    </li>
    <li>
      <a :href="'/user_works/'+user.slug" :class="{ active: isActive('/user_works/' + user.slug) }">
        My Previous Projects / Experiences  
      </a>
    </li>
    <li>
      <a :href="'/user_links/'+user.slug" :class="{ active: isActive('/user_links/' + user.slug) }">
        My Links
      </a>
    </li>
  </ul>
</div>
	</template>