
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Animation 
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Animation/'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        
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
                  <th>title</th>
                  <th>Tags</th>
                  <th>Path</th>
                  <th>Size</th>
                  <th>Date of Created</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php                 
                if(!empty($records)) :
                foreach ($records as $record) { ?>
               
                <tr>
                <td><?php echo $record->title;?></td>
                  <td><?php echo $record->tags;?></td>
                  <td><?php echo $record->animationFilePath;?></td>
                  <td><?php $number= $record->size/1000; echo number_format((float)$number, 2, '.', ''.''); ?>Mb</td>
                  <td><?php echo $record->dateOfCreated;?></td>
                  <td>
                     <a href="<?php echo site_url("Animation/edit/" . $record->id);?>" class="btn btn-warning">Edit</a>
                    <a href="<?php echo site_url("Animation/delete/" . $record->animationFileName);?>" 
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
