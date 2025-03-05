<script>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';


 export default {
  data() {
    return {
      tree1: false,
      tree2: false,
      tree3: false,
      tree4: false,
      tree5: false,
      
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
  }
}
</script>

<template>
<div>  
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     
   
 
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../index3.html" class="brand-link">
      <img src="/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
     <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="#" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>-->
 

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
       
	   
	   <ul class="list_group margbtm">
          <li class="nav-item">
            <a href="/admin/index"  :class="{ 'active': isCurrentPath('/admin/index') }"  class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Admins 
              </p>
            </a>
          </li>
		  
		  	<li class="nav-item">
					<a href="/admin/user/index"  :class="{ 'active': isCurrentPath('/user/index') }"  class="nav-link">
					  <i class="nav-icon fas fa-th"></i>
					  <p>
						Users
					  </p>
					</a>
			</li>
			
			
			
			<li class="nav-item">
					<a href="/admin/department/index"  :class="{ 'active': isCurrentPath('/department/index') }"  class="nav-link">
					  <i class="nav-icon fas fa-th"></i>
					  <p>
						departments
					  </p>
					</a>
			</li>
			  
				<li class="nav-item">
					<a href="/admin/service_category/index"  :class="{ 'active': isCurrentPath('/service_category/index') }"  class="nav-link">
					  <i class="nav-icon fas fa-th"></i>
					  <p>
						service category
					  </p>
					</a>
			</li>
		 <li class="nav-item">
					<a href="/admin/service/index"  :class="{ 'active': isCurrentPath('/admin/service/index') }"  class="nav-link">
					  <i class="nav-icon fas fa-th"></i>
					  <p>
						services  
					  </p>
					</a>
			</li> 
			
		 </ul>
		  
		  
		  
				
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
	     <slot />
	  </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
</div>
</template>
