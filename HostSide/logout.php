<?php
include 'headerlinks.html';
session_start();
if(!isset($_SESSION['role']))
{
	header("location:index.php");	
}
?>
<body>
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
							$.get('commons.php',{action:'logout'},function(data)
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
													  window.location.href = 'homePage.php';
											});	
								}
							});	
						}	
					  	else
					  	{
					  		window.location.href = 'homePage.php';	
					  	}
					});
			   });

</script>
</body>
