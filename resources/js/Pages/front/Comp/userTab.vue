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
        {{ __("cv_tab") }}
      </a>
    </li>
    <li>
      <a :href="'/user_services/'+user.slug" :class="{ active: isActive('/user_services/' + user.slug) }">
       	 {{ __("my_servcies") }}
      </a>
    </li>
    <li>
      <a :href="'/user_works/'+user.slug" :class="{ active: isActive('/user_works/' + user.slug) }">
     	 {{ __("my_previous_projects") }}
      </a>
    </li>
    <li>
      <a :href="'/user_links/'+user.slug" :class="{ active: isActive('/user_links/' + user.slug) }">
        {{ __("my_links") }}
      </a>
    </li>
  </ul>
</div>
	</template>