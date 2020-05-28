
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Category List 
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('CategoryForModel/'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Date of Created</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php                 
                if(!empty($records)) :
                  $count = 1;
                foreach ($records as $record) { ?>
               
                <tr>
                  <td><?php echo $count++;?></td>
                <td><?php echo $record->name;?></td>
                  <td><?php echo $record->status;?></td>
                  <td><?php echo $record->dateofCreated;?></td>
  
                  <td>
                     <a href="<?php echo site_url("CategoryForModel/edit/" . $record->idCategory);?>" class="btn btn-warning">Edit</a>
                    <a href="<?php echo site_url("CategoryForModel/delete/" . $record->idCategory);?>" 
                        onclick="return confirm('Are you sure want to delete?');" class="btn btn-danger">Delete</a>

                  </td>
                </tr>
                <?php  } endif;?>
              
                </tbody>
  
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
