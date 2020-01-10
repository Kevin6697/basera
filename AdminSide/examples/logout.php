
<?php
session_start();
if(!isset($_SESSION['role']))
{
	header("location:index.php");	
}?>
<body>
	<link rel="stylesheet" type="text/css" href="../assets/css/sweetalert.css">
	<script src="../assets/js/core/jquery.min.js"></script>
	<script src="../assets/js/sweetalert.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			swal({
				title:"Logout",
				text: "Are you sure  you want to logout!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Yes, I am sure!',
				cancelButtonText: "No, cancel it!",
				closeOnConfirm: false,
				closeOnCancel: false
			},
			function(isConfirm){
				if(isConfirm)
				{
					$.get('delete.php',{action:'logout'},function(data)
					{
						if(data=="LoggedOut")
						{
							swal({
								title:"Logout Successfully!",
								type: "success"
							},
							function(){
								window.location.href = 'index.php';
							});
						}
						else
						{
							swal({
								title:"Sorry,Can't Logout",
								type: "error"
							},
							function(){
								window.location.href = 'dashboard.php';
							});	
						}
					});	
				}	
				else
				{
					window.location.href = 'dashboard.php';	
				}
			});
		});

	</script>
</body>