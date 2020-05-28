


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add 3D Model
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Admin/welcome'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo site_url('OperationTo3DModel'); ?>">View</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
         <div class="box box-primary">
            <div class="box-header with-border">
              
            </div>
                          
               <?php echo form_open_multipart('OperationTo3DModel/doUpload');?>

              <div class="row">
              <div class="col-sm-1"></div>  
              <div class="col-sm-4">  
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" class="form-control" id="3ModelTitle" name="3ModelTitle" placeholder="">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Tags</label>
                  <input type="text" class="form-control" id="3DModelTags" name="3DModelTags" placeholder="">
                </div>

                <div class="form-group">
                  <select class="form-control" name="modelCategory" id="modelCategory" required="required">
                    <option value="" selected="selected" disabled="disabled">Select Categories</option>
                    <?php if(!empty($categories)): 
                    foreach($categories as $category){ ?>
                        <option value="<?php echo $category->idCategory;?>"><?php echo $category->name; ?></option>
                    <?php } endif;?>
                  </select>
                </div>

				  <div class="form-group">
					  <label for="inputstatus">Status</label>
					  <div class="radio">
						  <label>
							  <input type="radio" name="modelStatus" id="optionsRadios1" value="active" checked>
							  Active
						  </label>
					  </div>
					  <div class="radio">
						  <label>
							  <input type="radio" name="modelStatus" id="optionsRadios2" value="inactive">
							  InActive
						  </label>
					  </div>

				  </div>

                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
               
                <div class="form-group">
                  <label for="shaderfileUpload">File input</label>
                  <input type="file" id="3DModelfileUpload" name="3DModelfileUpload">
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary">Upload</button>
              </div>

              </div>

              <div class="col-sm-1"></div>
               <?php
                if ($success=$this->session->flashdata('msg')) { ?>
                 <div id="success" class="col-sm-3">
                   <div class="alert alert-success alert-dismissible">
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
