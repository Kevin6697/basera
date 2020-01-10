<?php
session_start();
	$result="";
	require_once 'Host.php';
	$host = new HostController();
	if(isset($_POST['submit']))
	{
		$result=$host->changePassword();
	}	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Basera</title>
	<!-- favicon -->
	<link rel="shortcut icon" href="images/icon-ups-drinks.png">
	<script src="js/jquery-1.11.3.min.js"></script>
	<script>
	$(document).ready(function()
	{	
		$('#password-field').blur(function()
		{
			var password=$("#password-field").val();
			var check=/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;;
			if(!check.test(password))
			{
			$("#password-field").focus();
			$("#passworderror").show();
			$("#submit").hide();
			}
			else{
			$("#passworderror").hide();
			$("#submit").show();
			}
		});
		$("#txtConfPassword").blur(function(){
			var newPassword=$("#password-field").val();
			var confPassword=$(this).val();
			if(newPassword!=confPassword)
			{
				$("#txtConfPassword").focus();
				$("#confpassworderror").show();
				$("#submit").hide();
			}
			else
			{
				$("#confpassworderror").hide();
				$("#submit").show();
			}
		});
});
	</script>
	
	 <style type="text/css">
		.field-icon {
			float: right;
			margin-left: -25px;
			margin-top: 3px;
			position: relative;
			z-index: 2;
			}
	</style>
<?php
		include 'headerlinks.html';
	?>

	</head>
	<body>
		<!-- Overlay preloader-->
		<div class="htlfndr-loader-overlay"></div>

		<div class="htlfndr-wrapper">
			<header>
				<?php
					include 'header.php';
				?>
				<!-- Start of slider section -->
				<section class="htlfndr-slider-section">
					
				</section><!-- .htlfndr-slider-section -->
				<!-- End of slider section -->
				<noscript><h2>You have JavaScript disabled!</h2></noscript>
			</header>

			<!-- Start of main content -->
			<main role="main">
				<!-- Section with popular destinations -->
				<section class="container htlfndr-top-destinations">
					<h2 class="htlfndr-section-title "><span>Change Password </span></h2>
						<div class="col-md-16" style="padding-left:20%;">
						  <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
					       	<div class="col-md-8">
									 <label for="contact-name" class="htlfndr-required htlfndr-top-label">Old Password</label>
									<input type="password"  name="txtOldPassword" placeholder="ex:Demo@123" class="htlfndr-review-form-input" required >
									 <span  style="color: red">
									 	<?php
									 		if(isset($result))
									 		{
												if($result=="Your Previous Password does not match")
									 			{
									 				echo $result;
									 			}
									 		}
									 	?>
									 </span>
								   </div>
							<div class="col-md-8">
								<br>
									 <label for="contact-name" class="htlfndr-required htlfndr-top-label">New Password</label>
									<input type="password"  name="txtNewPassword" id="password-field" placeholder="ex:Demo@123" class="htlfndr-review-form-input demo" required >
								    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-passwordnew"></span>
                	                <span id="passworderror" style="display: none; color: red">Invalid Password Minimum of 8 characters with 1 uppercase 1 special character and 1 number</span>	
								</div>
								<div class="col-md-8">
								<br>
								<br> 
									 <label for="contact-name" class="htlfndr-required htlfndr-top-label">Confirm Password</label>
									<input type="password"  name="txtConfPassword" id="txtConfPassword" placeholder="ex:Demo@123" class="htlfndr-review-form-input demo" required >
								    <span id="confpassworderror" style="display: none; color: red">Both Password didn't match</span>	
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<input type="submit" id="submit"  name="submit" value=" Change Password " class="btn-primary">
						<br>
						<br>
						<br>
						<br>
						<?php
							 		if(isset($result))
							 		{
							 			if($result!="Your Previous Password does not match")
							 			{
							 				if($result=="Changed")
							 				{
							 				?>
										<script>
											$(document).ready(function() {
												swal({
														title:"Success",
														text: "Your Password has been Changed!",
														type: "success"
													},
													  function(){
													    window.location.href = 'homePage.php';
												});
											});
										</script>
							 				<?php
							 				}
							 				else
							 				{
							 					echo "<span  style=\" color: red;\">".$result."</span>";
							 				}
							 			}
							 		}
							 	?>
						</form>
					    </div>
					 		</div>	
					</div>	
				</section><!-- .container.htlfndr-top-destinations -->
				
				
				</main>
			<footer class="htlfndr-footer">
			<!-- End of main content -->
			<?php
				include 'footer.html';
			?>
		</div><!-- .htlfndr-wrapper -->
		<?php
			include 'footerlinks.html';
		?>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
  	 <script>
  	 		 $(".toggle-passwordnew").click(function() {

				  $(this).toggleClass("fa-eye fa-eye-slash");
				  var input = $($(this).attr("toggle"));
				  if (input.attr("type") == "password") {
				    input.attr("type", "text");
				  } else {
				    input.attr("type", "password");
				  }
				}); 
 </script>		
	</body>
</html>