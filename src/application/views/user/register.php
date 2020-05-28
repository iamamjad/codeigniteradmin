
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

	<!-- bootstrap datepicker -->
	<link rel="stylesheet" href="<?php echo base_url('assets/')?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/AdminLTE.min.css">

	<!-- iCheck -->
	<!--  <link rel="stylesheet" href="--><?php //echo base_url('assets/') ?><!--plugins/iCheck/square/blue.css">-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
	<div class="register-logo">
		<a href="#"><b>User</b>Registration</a>
	</div>

		<p class="login-box-msg">Register a new user</p>

		<form class="form-horizontal" id="registrationForm">
	<div class="row">

		<div class="form-group">
				<label for="personName" class="col-sm-2 control-label">Name</label>

				<div class="col-sm-10">
					<input type="text" class="form-control" name="personName" id="personName" placeholder="Name">
				</div>
			</div>
			<div class="form-group">
				<label for="personUsername" class="col-sm-2 control-label">Username</label>

				<div class="col-sm-10">
					<input type="text" class="form-control" onblur="checkPersonUsername();" name="personUsername" id="personUsername" placeholder="username">
				</div>
				<span id="msg" class="help-block"  style="text-align: center; color: red;"></span>

			</div>

			<div class="form-group">
				<label for="personEmail" class="col-sm-2 control-label">Email</label>

				<div class="col-sm-10">
					<input type="email" class="form-control" onblur="checkPersonEmail()" name="personEmail" id="personEmail" placeholder="Email">
				</div>
				<span id="msgforpersonemail" class="help-block"  style="text-align: center; color: red;">
				</span>
			</div>
				<div class="form-group">
					<label for="personPassword" class="col-sm-2 control-label">Password</label>

					<div class="col-sm-10">
						<input type="password" class="form-control" name="personPassword" id="personPassword" placeholder="password">
					</div>
				</div>

		<div class="form-group">
			<label for="inputName" class="col-sm-2 control-label">Birthday</label>

			<div class="col-sm-10">
				<input type="text" class="form-control pull-right" name="datepicker" id="datepicker" placeholder="Date of Birth">
			</div>
		</div>

		<div class="form-group">
			<label for="categories" class="col-sm-2 control-label">Categories</label>

			<div class="col-sm-10">
				<div class="col-sm-4">
					<label>
						<input type="radio" name="categories"  value="basic" checked>
						Basic
					</label>
				</div>
				<div class="col-sm-4">
					<label>
						<input type="radio" name="categories" value="premium">
						Premium
					</label>
				</div>

			</div>
		</div>

		<div class="form-group">
			<label for="gender" class="col-sm-2 control-label">Gender</label>

			<div class="col-sm-10">
				<div class="col-sm-4">
					<label>
						<input type="radio" name="gender"  value="male" checked>
						Male
					</label>
				</div>
				<div class="col-sm-4">
					<label>
						<input type="radio" name="gender" value="female">
						Female
					</label>
				</div>

			</div>
		</div>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="termsandcondition"> I agree to the <a href="">terms and conditions</a>
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="button" name="saveChanges" id="saveChanges" class="btn btn-default">Submit</button>
				</div>
			</div>
		<span id="successMessage1" style="text-align: center; color: red; margin-left: 16px !important;"></span>
			</div>
			<span id="successMessage2" style="text-align: center; color: green;"></span>
		</form>

	<!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!--iCheck -->
<!--<script src="--><?php //echo base_url('assets/plugins/iCheck/icheck.min.js') ?><!--"></script>-->

<script type="text/javascript">
    $(document).ready(function(){
        $("#saveChanges").click(function(){
            var csrf_token        = '';
            var personName        = $("#personName").val();
            var personUsername    = $("#personUsername").val();
            var personEmail       = $("#personEmail").val();
            var personPassword    = $("#personPassword").val();
            var datepicker    	  = $("#datepicker").val();
            console.log(datepicker);
            var categories 	      = $("input[name='categories']:checked").val();
            var gender 	          = $("input[name='gender']:checked").val();
            var termsandcondition = $("input[name='termsandcondition']:checked").val();
            if(csrf_token ===''){
				csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>'
			}
            var dataString = {'personName':personName,'personUsername':personUsername, 'categories':categories,'datepicker':datepicker,'gender':gender,
                'personEmail':personEmail,'personPassword':personPassword,'<?php echo $this->security->get_csrf_token_name();?>':csrf_token};

            if(personName=='' || personUsername=='' || personEmail=='' || personPassword=='' || termsandcondition=='')
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
                    url: "<?php echo base_url(); ?>Users/insert",
                    data: dataString,
                    dataType: 'html',
                    cache: false,
                    success: function(data){
                        var k = JSON.parse(data);
                        if(k.csrf_token)
                        {
                            csrf_token =k.csrf_token;
						}
                        //console.log(data);
                        // $('[name="personName"]').val("");
                        // $('[name="personUsername"]').val("");
                        // $('[name="personEmail"]').val("");
                        // $('[name="personPassword"]').val("");
                        // $('[name="personPhoneNumber"]').val("");
                        // $('[name="categories"]').val("");
						// $("#successMessage2").show();
                        $("#successMessage2").text( 'You are signup successfully Verfication email has been send to you Mail.');
                        $('#successMessage2').delay(1000).fadeOut('fast');
                        document.getElementById("registrationForm").reset();
                    },
                    error:function(data){
                        console.log("failed");
                    }
                });

            }

            return false;

        });
    });

    function checkPersonUsername()
	{
	    var personUsername = $("#personUsername").val();

		$.ajax(
            {
                type:"post",
                url: "<?php echo base_url(); ?>Users/personUsername",
                data:{ personUsername:personUsername},
                success:function(response)
                {
                    console.log(response);
                    if (response == true)
                    {
                        $("#msg").show();
                        $("#msg").text( 'UserName already exist');
                        $('#msg').delay(2000).fadeOut('fast');
						$('[name="personUsername"]').val("");
                    }
                }
            });
	}

	function checkPersonEmail()
	{
		var personEmail = $("#personEmail").val();

		$.ajax(
			{
				type:"post",
				url: "<?php echo base_url(); ?>Users/personEmail",
				data:{ personEmail:personEmail},
				success:function(response)
				{
					console.log(response);
					if (response == true)
					{
						$("#msgforpersonemail").show();
						$("#msgforpersonemail").text( 'Email already exist');
						$('#msgforpersonemail').delay(2000).fadeOut('fast');
						$('[name="personEmail"]').val("");
					}
				}
			});
	}

	//Date picker

</script>

<script src="<?php echo base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
<script>

	//Date picker
	$('#datepicker').datepicker({
		autoclose: true
	})
</script>

</body>
</html>




