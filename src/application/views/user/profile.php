<?php //echo '<pre>'; print_r($records); exit();?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		  <?php !empty($page_title); echo $page_title;?>
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Users/'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        
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
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover">
							<tr>
								<th>Userid</th>
								<th>File Storage</th>
								<th>Date</th>

							</tr>
							<tr>
								<?php
								if(!empty($records)){
								foreach ($records as $record){?>
								<td><?php  echo $record['idAppUser'];?></td>
								<td><?php  echo $record['file_storage'];?></td>
								<td><?php  $phpdate = strtotime( $record['dateofCreated'] );  echo date( 'd-M-Y H:i:s', $phpdate ); ?></td>
							</tr>

							<?php } }?>

						</table>
					</div>

				</div>

			</div>
		</div>
    </section>

  </div>

</body>
</html>
