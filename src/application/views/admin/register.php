<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> Registration Page</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/AdminLTE.min.css">

	<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>


</head>
<body class="hold-transition register-page">
<div class="register-box">
	<div class="register-logo">
		<a href="#"><b>Web</b>Management</a>
	</div>

	<div class="register-box-body">
		<p class="login-box-msg">Register a new user</p>

		<form class="form-horizontal" id="usersForm">

			<div class="form-group has-feedback">
				<input type="text" class="form-control" id="fullName" name="fullName" placeholder="Full name">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="text" class="form-control" id="email" name="email" placeholder="Email">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" id="password" name="password" placeholder="Password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="form-group">
<!--				<div class="checkbox">-->
<!--					<label>-->
<!--						<input type="checkbox" name="roles" id="roles" value="2">-->
<!--						User Management Account-->
<!--					</label>-->
<!--				</div>-->

				<div class="radio">
					<label>
						<input type="radio" checked="checked" name="roles" id="roles" value="1">
						Asset Management Account
					</label>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-4">
					<button type="button" name="saveChanges" id="saveChanges" class="btn btn-default">Submit</button>
				</div>
			</div>
			<span id="successMessage1" style="text-align: center; color: red; margin-left: 16px !important;"></span>
			<span id="successMessage2" style="text-align: center; color: green;"></span>
		</form>

	</div>
	<!-- /.form-box -->
</div>


<script>

	$(document).ready(function(){
		$("#saveChanges").click(function(){
			var csrf_token  = '';
			var fullName    = $("#fullName").val();
			var email       = $("#email").val();
			var password    = $("#password").val();
			var roles 	    = $("input[name='roles']:checked").val();
			if(csrf_token ===''){
				csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>'
			}
			var dataString =
			{
				'fullName':fullName, 'roles':roles,
				'email':email,'password':password,
				'<?php echo $this->security->get_csrf_token_name();?>':csrf_token
			};


			if(fullName=='' || email=='' || password=='' || roles=='')
			{
				$("#successMessage1").show();
				$("#successMessage1").text( 'Please Fill the all fields');
				$('#successMessage1').delay(2000).fadeOut('fast');
			}
			else
			{
				// AJAX Code To Submit Form.
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>Admin/registerNewUser",
					data: dataString,
					dataType: 'html',
					cache: false,
					success: function(data){
						var k = JSON.parse(data);
						if(k.csrf_token)
						{
							csrf_token =k.csrf_token;
						}

						$("#successMessage2").text( 'You are signup successfully.');
						document.getElementById("usersForm").reset();
						$('#successMessage2').delay(1000).fadeOut('fast');

						setTimeout(function()
						{
							location.reload();  //Refresh page
						}, 1000);
						// $('[name="fullName"]').val("");
						// $('[name="email"]').val("");
						// $('[name="password"]').val("");
						// $('[name="roles"]').val("");
					},
					error:function(data){
						console.log("failed");
					}
				});

			}

			return false;

		});
	});
</script>
</body>
</html>
