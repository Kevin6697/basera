<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php
		include 'headerlinks.html';
	?>
</head>
<body>
		<!-- Overlay preloader-->
		<div class="htlfndr-loader-overlay"></div>

		<div class="htlfndr-wrapper">
	
	 <script type="text/javascript">
										$(document).ready(function() {
											swal({
												title:"Success",
												text: "Successfully!",
												type: "success"
											},
											  function(){
											    window.location.href = 'homePage.php';
											});
									   });
	</script>	
		</div><!-- .htlfndr-wrapper -->
		<?php
			include 'footerlinks.html';
		?>
	</body>
</html>			
