 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('PersonName'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

		  <?php if($this->session->userdata('personRole')==1) { ?>


            <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>All Assetbundles</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="<?php echo site_url();?>Assetbundles/add"><i class="fa fa-circle-o"></i> add</a></li>
            <li><a href="<?php echo site_url();?>Assetbundles"><i class="fa fa-circle-o"></i> view</a></li>
          </ul>
        </li>

			  <li class="treeview">
				  <a href="#">
					  <i class="fa fa-folder"></i> <span>IBM Storge</span>
					  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
				  </a>
				  <ul class="treeview-menu">
					  <li><a href="<?php echo site_url();?>IbmWaston/add"><i class="fa fa-circle-o"></i> add</a></li>
					  <li><a href="<?php echo site_url();?>IbmWaston"><i class="fa fa-circle-o"></i> view</a></li>
				  </ul>
			  </li>
          <li class="treeview">
          <a href="">
            <i class="fa fa-folder"></i> <span>3D models</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="<?php echo site_url();?>OperationTo3DModel/add"><i class="fa fa-circle-o"></i> add</a></li>
             <li><a href="<?php echo site_url();?>OperationTo3DModel/getAllCategory"><i class="fa fa-circle-o"></i> category</a></li>
			  <li><a href="<?php echo site_url();?>OperationTo3DModel/"><i class="fa fa-circle-o"></i> view</a></li>
		  </ul>
          </li>

              <li class="treeview">
          <a href="">
            <i class="fa fa-folder"></i> <span>Model Category </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="<?php echo site_url();?>CategoryForModel/add"><i class="fa fa-circle-o"></i> add</a></li>
             <li><a href="<?php echo site_url();?>CategoryForModel/"><i class="fa fa-circle-o"></i> view</a></li>
          </ul>
          </li>

           <li class="treeview">
          <a href="">
            <i class="fa fa-folder"></i> <span>Sounds Effects</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="<?php echo site_url();?>SoundsEffects/add"><i class="fa fa-circle-o"></i> add</a></li>
            <li><a href="<?php echo site_url();?>SoundsEffects/"><i class="fa fa-circle-o"></i> view</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Music Track </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu"> 
            <li><a href="<?php echo site_url();?>MusicTrack/add"><i class="fa fa-circle-o"></i> add</a></li>
            <li><a href="<?php echo site_url();?>MusicTrack/"><i class="fa fa-circle-o"></i> view</a></li>
          </ul>
        </li>
   
          <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Material</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           <ul class="treeview-menu"> 
            <li><a href="<?php echo site_url();?>Material/add"><i class="fa fa-circle-o"></i> add</a></li>
            <li><a href="<?php echo site_url();?>Material/"><i class="fa fa-circle-o"></i> view</a></li>
          </ul>
        </li>

        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Shaders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url();?>Shaders/add"><i class="fa fa-circle-o"></i> add</a></li>
            <li><a href="<?php echo site_url();?>Shaders"><i class="fa fa-circle-o"></i> view</a></li>
          </ul>
        </li>
          
          <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Skybox</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
             <ul class="treeview-menu"> 
            <li><a href="<?php echo site_url();?>Skybox/add"><i class="fa fa-circle-o"></i> add</a></li>
            <li><a href="<?php echo site_url();?>Skybox/"><i class="fa fa-circle-o"></i> view</a></li>
          </ul>
        </li>

          <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Animation</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           <ul class="treeview-menu"> 
            <li><a href="<?php echo site_url();?>Animation/add"><i class="fa fa-circle-o"></i> add</a></li>
            <li><a href="<?php echo site_url();?>Animation/"><i class="fa fa-circle-o"></i> view</a></li>
          </ul>
        </li>

		<li class="treeview">
				  <a href="#">
					  <i class="fa fa-folder"></i> <span>Accounts</span>
					  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
				  </a>
				  <ul class="treeview-menu">
					  <li><a href="<?php echo site_url();?>Accounts/add"><i class="fa fa-circle-o"></i> add</a></li>
					  <li><a href="<?php echo site_url();?>Accounts/"><i class="fa fa-circle-o"></i> view</a></li>
				  </ul>
			  </li>

			  <li class="treeview">
				  <a href="#">
					  <i class="fa fa-folder"></i> <span>Database</span>
					  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
				  </a>
				  <ul class="treeview-menu">
					  <li><a href="<?php echo site_url();?>Admin/db_backup"><i class="fa fa-circle-o"></i> Backup</a></li>
				  </ul>
			  </li>

		  <?php } else { ?>

         <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url();?>Users"><i class="fa fa-circle-o"></i> view</a></li>
          </ul>
        </li>

		  <?php } ?>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
