
// $(document).ready(function(){
//
//
// 	$("#save").click(function(){
//
//
// 		var fullName    = $("#fullName").val();
// 		console.log(fullName);
// 		var email       = $("#email").val();
// 		var password    = $("#password").val();
// 		var roles 	    = $("input[name='roles']:checked").val();
// 		var dataString =
// 			{
// 				'fullName':fullName, 'roles':roles,
// 				'email':email,'password':password
// 			};
//
//
// 		if(fullName=='' || email=='' || password=='' || roles=='')
// 		{
// 			$("#successMessage1").show();
// 			$("#successMessage1").text( 'Please Fill the all fields');
// 			$('#successMessage1').delay(2000).fadeOut('fast');
// 		}
// 		else
// 		{
// 			// AJAX Code To Submit Form.
// 			$.ajax({
// 				type: "POST",
// 				url: "<?php echo base_url(); ?>Accounts/insert",
// 				data: dataString,
// 				dataType: 'html',
// 				cache: false,
// 				success: function(data){
//
// 					$("#successMessage2").text( 'Your  accounts has been created successfully.');
// 					document.getElementById("accountForm").reset();
// 					$('#successMessage2').delay(1000).fadeOut('fast');
//
// 					setTimeout(function()
// 					{
// 						location.reload();  //Refresh page
// 					}, 1000);
//
// 				},
// 				error:function(data){
// 					console.log("failed");
// 				}
// 			});
//
// 		}
//
// 		return false;
//
// 	});
// });


	// $(document).ready(function(){
	// 	$("#saveChanges").click(function(){
	// 		var oldPassword = $("#oldPassword").val();
	// 		var newPassword = $("#newPassword").val();
	// 		var confirmNewPassword = $("#confirmNewPassword").val();
	// 		var dummy = $("#dummy").val();
	// 		var dataString = {'oldPassword':oldPassword,'newPassword':newPassword,'confirmNewPassword':confirmNewPassword,'dummy':dummy};
	// 		if(oldPassword=='' || newPassword=='' || confirmNewPassword=='')
	// 		{
	//
	// 			$("#successMessage1").show();
	// 			$("#successMessage1").text( 'Please Fill the all fields');
	//
	// 		}
	//
	// 		if(newPassword !== confirmNewPassword)
	// 		{
	//
	// 			$("#passwordNotMatch").show();
	// 			$("#passwordNotMatch").text( 'Password does not matached');
	// 		}
	//
	// 		else
	// 		{
	// 			// AJAX Code To Submit Form.
	// 			$.ajax({
	// 				type: "POST",
	// 				url: "<?php echo base_url(); ?>Admin/changeAdminPassword",
	// 				data: dataString,
	// 				dataType: 'json',
	// 				cache: false,
	// 				success: function(data){
	//
	// 					console.log(data);
	// 					$("#changePasswordForm")[0].reset();
	// 				}
	// 			});
	//
	// 		}
	//
	// 		return false;
	//
	// 	});
	// });

