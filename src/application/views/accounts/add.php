

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Accounts
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Accounts/welcome'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo site_url('Accounts'); ?>">View</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="col-sm-6 offset-6">
			<div class="panel panel-primary">
				<div class="panel-heading">Add Accounts</div>
				<div class="panel-body">
					<div class="container">
						<?php echo validation_errors(); ?>
						<?php $attribue = array('class'=>'form-horizontal','id'=>'account-form'); echo form_open('accounts/insert',$attribue); ?>
							<div class="row">
								<div class="col-sm-4 offset-4">
									<div class="form-group has-feedback">

										<input type="text" class="form-control"  value="<?php echo set_value('fullName'); ?>" size="15" id="fullName" name="fullName" placeholder="Full name">
										<span class="glyphicon glyphicon-user form-control-feedback"></span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-4 offset-4">
									<div class="form-group has-feedback">
										<input type="text" class="form-control" value="<?php echo set_value('email'); ?>" id="email" name="email" placeholder="Email">
										<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4 offset-4">
									<div class="form-group has-feedback">
										<input type="password" class="form-control" value="<?php echo set_value('password'); ?>" id="password" name="password" placeholder="Password">
										<span class="glyphicon glyphicon-lock form-control-feedback"></span>
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-sm-4 offset-4">
									<div class="form-group">
										<div class="radio">
											<label>
												<input type="radio" name="roles" id="roles" value="2">
												User Management Account
											</label>
										</div>

										<div class="radio">
											<label>
												<input type="radio"  name="roles" id="roles" value="1">
												Asset Management Account
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4 offset-4">
									<button type="submit" name="save" id="save" class="btn btn-default">Submit</button>
								</div>
							</div>
							<span id="successMessage1" style="text-align: center; color: red; margin-left: 16px !important;"></span>
							<span id="successMessage2" style="text-align: center; color: green;"> <?php echo $this->session->flashdata('msg');?></span>
						<?php echo form_close();?>
					</div>
				</div>
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

	  document.getElementById("account-form").reset();
	  $('#successMessage2').delay(1000).fadeOut('fast');

  </script>


