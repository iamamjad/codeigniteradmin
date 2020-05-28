

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        3D Model 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Admin/welcome"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <?php 
        if(!empty($categories)):
          foreach ($categories as $category) { ?>
              <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <?php
           $categoryId = '';
          $categoryId = $category->idCategory;
          switch ($categoryId) {
            case '1':
            echo ' <div class="small-box bg-aqua">';
              break;
            case '2':
            echo ' <div class="small-box bg-green">';
            break;
            case '3':
            echo ' <div class="small-box bg-yellow">';
            break;
            case '4':
            echo ' <div class="small-box bg-red">';
            break;

            case '5':
            echo ' <div class="small-box bg-aqua">';
            break;

            case '6':
            echo ' <div class="small-box bg-green">';
            break;
            case '7':
            echo ' <div class="small-box bg-yellow">';
            break;
            case '8':
            echo ' <div class="small-box bg-red">';
            break;
           
            default:
               echo ' <div class="small-box bg-green">';
              break;
          }
          ?>
         
            <div class="inner">
              <?php $CI = & get_instance(); ?>
              
              <h3><?php $CI->QueryTo3dModel->getCountOfEachCategory($category->idCategory); ?></h3> 
            
              <p><?php echo $category->name;?></p>
            </div>
            <div class="icon">
              <?php
                $categoryName= '';
                $categoryName =$category->name;
                switch ($categoryName) {
                   case 'Car':
                   echo '<i class="ion ion-stats-bars"></i>';
                     break;
                   case 'Stone':
                   echo '<i class="ion ion-person-add"></i>';
                   break;

                   case 'Tree':
                   echo '<i class="ion ion-pie-graph"></i>';
                   break;
                   case 'House':
                   echo '<i class="ion ion-bag"></i>';
                   break;
                   default:
                    echo '<i class="ion ion-stats-bars"></i>';
                     break;
                 } 
               ?>
              
            </div>
            <a href="<?php echo site_url("OperationTo3DModel/getEachCategoryById/".$category->idCategory);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
          <?php } endif;?>
      
        <!-- ./col -->
 
        <!-- ./col -->
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</body>
</html>
