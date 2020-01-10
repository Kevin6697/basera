<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Basera</title>
	<!-- favicon -->
	<link rel="shortcut icon" href="images/icon-ups-drinks.png">
	<?php
		include 'headerlinks.html';
	?>
</head>
<body class="single">
<!-- Overlay preloader-->
<div class="htlfndr-loader-overlay"></div>

	<div class="htlfndr-wrapper">
	<!-- Start of main content -->
		<header>
			<?php
				include 'headerlinks.html';
			?>
			<link rel="stylesheet" type="text/css" href="css/multistep-form.css">
			<script src="js/jquery-1.11.3.min.js"></script>
			<script>
				$(document).ready(function(){
					$("#searchOption").change(function(){
						var searchOption=$("#searchOption").val();
						if(searchOption=="checkIn")
						{
							$("#text").fadeOut();
							$("#dateTime").fadeIn();	
						}
						else
						{
							$("#text").fadeIn();
							$("#dateTime").fadeOut();	
						}
					});
				});
			</script>
			<script>
				$(document).ready(function(){
					$("#searchOption").focus();
				});
				function search(key)
				{
					var searchOption =document.getElementById('searchOption');
					if(searchOption.value=="search")
					{
						alert("Please select Proper Option");
					}
					r =new XMLHttpRequest();
					r.open("GET","search.php?t1="+key+"&t2="+searchOption.value,true);
					r.send();
					r.onreadystatechange=function()
					{
						if(r.readyState==4 && r.status==200)
						{
							$("#data").html(r.responseText);
						}
					}
				}
				function searchOptionValidate()
				{
					var searchOption =document.getElementById('searchOption');
					if(searchOption.value=="search")
					{
						alert("Please select Proper Option");
					}
				}
			</script>
			<script src="js/multistep-form.js"></script>
	
				<?php
					include 'header.php';
				?>
				
				<noscript><h2>You have JavaScript disabled!</h2></noscript>
			</header>
			<div class="container">
				<main id="htlfndr-contact-us" class="htlfndr-main-content" role="main">	
					<div class="row htlfndr-contact-page">
						<main role="main">
							<section class="container htlfndr-top-destinations">
								<h2 class="htlfndr-section-title">search bookings</h2>
								<div class="htlfndr-section-under-title-line"></div>
								<div class="col-md-8" >
									<div id="wrapper">
											<div id="account_details" style="margin-top: 
											-40px;">
											 	<form action="<?php echo $_SERVER['PHP_SELF']?>" id="htlfndr-contact-form" method="post">
											 	<label for="contact-name" class="htlfndr-required htlfndr-top-label"style="margin-top: 
											-40px;">Search Option</label>
											 	<select name="searchOption" id="searchOption" class=htlfndr-review-form-input onblur="searchOptionValidate();">
											 		<option value=search selected>Search By...</option>
											 		<option value="custName">Customer Name</option>
											 		<option value="houseName">
											 		House Name</option>
											 		<option value="checkIn">Check-In Date</option>
											 	</select>
											 	<br>
											 	<br>
												<input type="text" name="searchBox" id="text" class=htlfndr-review-form-input oninput="search(this.value);">
										 		<input type="date" style="display: none" name="searchBox" id="dateTime" class=htlfndr-review-form-input oninput="search(this.value);">
											 	<p id="data"></p>
											</div> 	
								<br>
									 </form>
									</div>
								</div>		
							</section>
						</main>
					</div>
				</main>
			</div>	

</div>

<footer class="htlfndr-footer">
		<?php
				include 'footer.html';
			?>
		</div><!-- .htlfndr-wrapper -->
		<?php
			include 'footerlinks.html';
		?>
</footer>		
</body>
</html>