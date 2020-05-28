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
        Edit Assets Bundles
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Admin/welcome'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo site_url('Assetbundles'); ?>">View</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
         <div class="box box-primary">
            <div class="box-header with-border">
              
            </div>
                          
               <?php echo form_open_multipart('Assetbundles/edit/'.$record['id']);
               ?>

              <div class="row">
              <div class="col-sm-1"></div>  
              <div class="col-sm-5">  
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" value="<?php echo $record['title']; ?>" id="assetBundleTitle" name="assetBundleTitle" placeholder="">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tags</label>
                  <input type="text" class="form-control" value="<?php echo $record['tags'] ?>" id="assetBundleTags" name="assetBundleTags" placeholder="">
                </div>
               
                <div class="form-group">
                  <label for="shaderfileUpload">File input</label>
                  <input type="file" id="assetBundlefileUpload" name="assetBundlefileUpload">

                  <i class="fa fa-file-text-o"><?php echo $record['assetBundlesFileName']; ?></i>
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
                 <div id="successMessage" class="col-sm-3">
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

</body>
</html>
<script>
$('#successMessage').delay(500).fadeOut('fast');
</script>
