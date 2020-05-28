
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       3D Model Edit
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
                          
               <?php echo form_open_multipart('OperationTo3DModel/edit/'.$record['id']);
               ?>

              <div class="row">
              <div class="col-sm-1"></div>  
              <div class="col-sm-5">  
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" class="form-control" value="<?php echo $record['title']; ?>" id="3DModelTitle" name="3DModelTitle" placeholder="">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tags</label>
                  <input type="text" class="form-control" value="<?php echo $record['tags'] ?>" id="3DModelTags" name="3DModelTags" placeholder="">
                </div>

				  <div class="form-group">
					  <label for="inputstatus">Status</label>
					  <div class="radio">
						  <label>
							  <input type="radio" name="modelStatus" id="optionsRadios1" value="active" <?php
							  echo set_value('modelStatus', $record['status']) == 'active' ? "checked" : "";
							  ?> />
							  Active
						  </label>
					  </div>
					  <div class="radio">
						  <label>
							  <input type="radio" name="modelStatus" id="optionsRadios2" value="inactive" <?php
							  echo set_value('modelStatus', $record['status']) == 'inactive' ? "checked" : "";
							  ?>>
							  InActive
						  </label>
					  </div>

				  </div>

                   <div class="form-group">
                  <select class="form-control" name="modelCategory" id="modelCategory" required="required">
                    <option value="" selected="selected" disabled="disabled">Select Categories</option>
                    <?php if(!empty($categories)): 
                    foreach($categories as $category){ ?>
                        <option value="<?php echo $category->idCategory;?>" 
                          <?php echo set_value('modelCategory',$record['idCategory'] == $category->idCategory) ? "selected= 'selected'" : ''?>  ><?php echo $category->name; ?></option>
                    <?php } endif;?>
                  </select>
                </div>
               
                <div class="form-group">
                  <label for="shaderfileUpload">File input</label>
                  <input type="file" id="3DModelfileUpload" name="3DModelfileUpload">

                  <i class="fa fa-file-text-o"><?php echo $record['model_fileName']; ?></i>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary">Upload</button>
              </div>

              </div>
              <div class="col-sm-1"></div>
                            <?php
                if ($editSuccess=$this->session->flashdata('editSuccess')) { ?>
                 <div id="editSuccess" class="col-sm-3">
                   <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
               <?php echo $editSuccess; ?>
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
  <!-- /.content-wrapper -->
</body>
</html>

<script>
$('#editSuccess').delay(1000).fadeOut('fast');
</script>
