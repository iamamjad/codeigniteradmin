<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<hr>
<div class="container">
	<div class="row">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="text-center">
							<h3><i class="fa fa-lock fa-4x"></i></h3>
							<h2 class="text-center">Update Password</h2>
							<p>Please enter the new password</p>
							<div class="panel-body">


									<?php echo form_open_multipart('Users/enterNewPassword');?>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
												<input id="newPassword" name="newPassword" placeholder="New Password" class="form-control" type="password" required="required">
											</div>

											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
												<input id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm Password" class="form-control" type="password" required="required">
											</div>

											<span id="exist" style="color:red;"><?php echo $this->session->flashdata('exist'); ?></span>
										</div>
										<div class="form-group">
											<input class="btn btn-lg btn-default btn-block" value="Update" type="submit">
										</div>

								<span id="success" style="color:green;"><?php echo $this->session->flashdata('msg'); ?></span>
								<?php echo form_close();?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
    $('#exist').delay(2000).fadeOut('fast');
    $('#success').delay(2000).fadeOut('fast');
</script>
