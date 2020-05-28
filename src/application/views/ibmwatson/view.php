<?php

if ($this->session->userdata('personRole') == 2)
{
	redirect('Users/');
}

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		  <?php !empty($page_title); echo $page_title;?>
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('IbmWaston/'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        
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
                 <th>Path</th>
                  <th>Date of Created</th>
					<th>Date of Updated</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php                 
                if(!empty($records)) :
                foreach ($records as $record) { ?>
               
                <tr>
                <td><?php echo $record->storageTitle;?></td>
				<td><?php echo $record->storagePath;?></td>
        <td><?php  $dateOfCreated = strtotime($record->dateOfCreated); echo date( 'd-M-Y H:i:s', $dateOfCreated ); ?></td>
        <td><?php  $dateOfUpdate = strtotime($record->dateOfUpdate);   echo date( 'd-M-Y H:i:s', $dateOfUpdate ); ?></td>
                  <td>
                     <a href="<?php echo site_url("IbmWaston/edit/" . $record->storageId);?>" class="btn btn-warning">Edit</a>
                    <a href="<?php echo site_url("IbmWaston/delete/" . $record->storageName);?>"
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
