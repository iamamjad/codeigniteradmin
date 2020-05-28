


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Category
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('CategoryForModel/'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo site_url('CategoryForModel'); ?>">View</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
         <div class="box box-primary">
            <div class="box-header with-border">
              
            </div>
                          
               <?php echo form_open_multipart('CategoryForModel/edit/'.$record['idCategory']);
               ?>

              <div class="row">
              <div class="col-sm-1"></div>  
              <div class="col-sm-4">  
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" value="<?php echo $record['name'];?>" id="categoryName" name="categoryName" placeholder="">
                </div>


                <div class="form-group">
                  <label for="exampleInputEmail1">Status</label>
                  <select class="form-control" name="categoryStatus" id="categoryStatus" required="required">
                  <option value="Active" <?php echo set_value('categoryStatus',$record['status']=='Active')? "selected='selected' " : '' ?>>Active</option>
                <option value="InActive" <?php echo set_value('categoryStatus',$record['status'] == 'InActive') ? "selected= 'selected'" : ''?> >InActive</option>
                  </select>
                </div>
                   
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-success">Update</button>
              </div>
              </div>

              <div class="col-sm-1"></div>
               <?php
                if ($success=$this->session->flashdata('msg')) { ?>
                 <div class="col-sm-3">
                   <div id="success" class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
               <?php echo $success; ?>
              </div>
                 </div>
                 
                
                          
                <?php } ?>  
              </div>
            <?php echo form_close();?>
           
          </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

</body>
</html>

<script>
$('#success').delay(1000).fadeOut('fast');
</script>
