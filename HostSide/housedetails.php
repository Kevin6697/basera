<?php
	require_once 'Host.php';
	$host = new HostController();
	$result1=$host->areaFetch();
	$result2=$host->aminitiesFetch(0);
	$result3=$host->nearbyFetch(0);
	if(isset($_POST['register']))
	{
		if(!isset($_POST['nearby']))
		{
			$result= "Please selected atleast one nearby ";
		}
		
		elseif(!isset($_POST['aminities']))
		{
			$result= "Please selected atleast one aminity ";
		}
		else
		{
			$result=$host->registrationHome();
		}
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
</style>
	<?php
		include 'headerlinks.html';
	?>
	<link rel="stylesheet" type="text/css" href="css/multistep-form.css">
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAd51MOn9Ba7Ih7diREEZfadNzheFj6n48&callback=initMap" type="text/javascript"></script>
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/HouseValidation.js"></script>
	<script src="js/multistep-form.js"></script>
	<script src="js/map.js"></script>
	<script src="../dist/js/standalone/selectize.js"></script>
		<script src="js/index.js"></script>
	</head>
	<body>
		<!-- Overlay preloader-->
		<div class="htlfndr-loader-overlay"></div>

		<div class="htlfndr-wrapper">
			<header>
				<?php
					include 'header.php';
				?>
				
				<noscript><h2>You have JavaScript disabled!</h2></noscript>
			</header>
			<main role="main">
				<br>
				<br>
				<br>
				<br>
				<!-- Section with popular destinations -->
				<section class="container htlfndr-top-destinations">
  	 				  <span class='baricon'>1</span>
					  <span id="bar1" class='progress_bar'></span>
					  <span class='baricon'>2</span>
					  <span id="bar2" class='progress_bar'></span>
					  <span class='baricon'>3</span>
					  <span id="bar3" class='progress_bar'></span>
					  <span class='baricon'>4</span>
					  <span id="bar4" class='progress_bar'></span>
					  <span class='baricon'>5</span>
					  <span id="bar5" class='progress_bar'></span>
					  <span class='baricon'>6</span>
					   <span id="bar6" class='progress_bar'></span>
					  <span class='baricon'>7</span>
					<br>
					<br>
					<br>
				<div class="col-md-8" >
					<?php
								if(isset($result))
								{
									if($result!="Registered Successfully")
									{
										echo "<span style=\"margin-left:50%;color:red;\">".$result."</span>";	
									}
									else
									{
									?>
						 		    <script type="text/javascript">
									 window.location="demo.php";
									</script>	
									<?php	
									}
									
								}
							?>
				<div id="wrapper">
				 <form action="<?php echo $_SERVER['PHP_SELF']?>" id="htlfndr-contact-form" method="post" enctype="multipart/form-data">
		
					<div id="account_details">
						
							<br>
   								<label for="contact-name" class="htlfndr-required htlfndr-top-label">House Name</label>
								<input type="text" placeholder="ex:Demo" value="<?php if(isset($_POST['txtHouseName'])){ echo $_POST['txtHouseName'];}?>" id="fname" class="htlfndr-review-form-input" required name="txtHouseName">
								<br>
								<br>
    							<label for="contact-name" class="htlfndr-required htlfndr-top-label">No. of Guest Allowed</label>
								<input type="number" min=1 max=10 placeholder="ex:1" id="lname" value="<?php if(isset($_POST['txtGuest'])){ echo $_POST['txtGuest'];}?>" class="htlfndr-review-form-input"  required name="txtGuest" >
								<br>
								<br>
								<label for="contact-name" class="htlfndr-required htlfndr-top-label">Basic House Price</label>
								<input type="number" name="txtBasicPrice" min="500" id="basicPrice" class="htlfndr-review-form-input" value="<?php if(isset($_POST['txtBasicPrice'])){ echo $_POST['txtBasicPrice'];}?>" required placeholder="ex:1000">
								<br>
								<br>
	              				<label for="contact-name" class="htlfndr-required htlfndr-top-label">Price Per Person</label>
								<input type="number" name="txtPrice" min="50" id="pricePerson" class="htlfndr-review-form-input" value="<?php if(isset($_POST['txtPrice'])){ echo $_POST['txtPrice'];}?>" required placeholder="ex:1000">
								<br>
								<br>
								<label for="contact-name" class="htlfndr-required htlfndr-top-label">Number of Bedrooms</label>
								<input type="number" name="txtBedrooms" id="bedrooms" class="htlfndr-review-form-input" required placeholder="ex:5"  min=1 max=10 value="<?php if(isset($_POST['txtBedrooms'])){ echo $_POST['txtBedrooms'];}?>" >
	              				<br>
								<br>
	              				<label for="contact-name" class="htlfndr-required htlfndr-top-label">Number of Bathrooms</label>
								<input type="number" name="txtBathrooms" id="bathrooms" class="htlfndr-review-form-input" required placeholder="ex:2"  min=1 max=10  value="<?php if(isset($_POST['txtBathrooms'])){ echo $_POST['txtBathrooms'];}?>">
	              	
					    <br>
					    <input type="button" value="Next" class="btn-primary" onclick="validatePhase1();">
						    
					  </div>
					  <div id="user_details">
					  			<label for="contact-name" class="htlfndr-required htlfndr-top-label">House Description</label>
								<textarea name="txtDesc1" required id="description1" class="htlfndr-review-form-input" rows=5  placeholder=""><?php if(isset($_POST['txtDesc1'])){ echo $_POST['txtDesc1'];}?></textarea>
								<br>
								<br>
								<label for="contact-name" class="htlfndr-top-label">House Description</label>
								<textarea name="txtDesc2"  id="description2" class="htlfndr-review-form-input" rows=5  placeholder=""><?php if(isset($_POST['txtDesc2'])){ echo $_POST['txtDesc2'];}?></textarea>
							<br>
							<input type="button" value="Previous" class="btn-primary" onclick="show_prev('account_details','bar1');">
						    <input type="button" value="Next" class="btn-primary" onclick="validatePhase2();">
					 </div>
					 <div id="nearby_details">
					 	
					 </div>
					 <div id="rules_details">
					  			<label for="contact-name" class="htlfndr-top-label">Extra Rules you want Customer to follow 1 </label>
								<textarea name="txtRules1" id="number" class="htlfndr-review-form-input" maxlength="255" rows=5  placeholder="Max 255 Characters"><?php if(isset($_POST['txtRules1'])){ echo $_POST['txtRules1'];}?></textarea>
								<br>
								<br>
								<label for="contact-name" class="htlfndr-top-label">Extra Rules you want Customer to follow 2 </label>
								<textarea name="txtRules2" id="number" class="htlfndr-review-form-input" maxlength="255" rows=5  placeholder="Max 255 Characters"><?php if(isset($_POST['txtRules2'])){ echo $_POST['txtRules2'];}?></textarea>
	              	
	    					<br>
							<input type="button" value="Previous" class="btn-primary" onclick="show_prev('user_details','bar2');">
						    <input type="button" value="Next" class="btn-primary" onclick="show_next('rules_details','test_details','bar3');">
					 </div>
					 <div id="test_details">
   					 <label for="contact-name" class="htlfndr-required htlfndr-top-label">House Address Line1</label>
					<textarea name="txtAddr1" id="txtAddr1" class="htlfndr-review-form-input" rows=3   placeholder="" required><?php if(isset($_POST['txtAddr1'])){ echo $_POST['txtAddr1'];}?></textarea>
					<br>
					<br>
					<label for="contact-name" class="htlfndr-top-label">House Address Line2</label>
					<textarea name="txtAddr2" id="txtAddr2" class="htlfndr-review-form-input" rows=2  placeholder=""><?php if(isset($_POST['txtAddr2'])){ echo $_POST['txtAddr2'];}?></textarea>
					<br>
					<br>			
					<label for="contact-name" class="htlfndr-top-label">House Address Line3</label>
					<textarea name="txtAddr3" id="txtAddr3" class="htlfndr-review-form-input" rows=2  placeholder=""><?php if(isset($_POST['txtAddr3'])){ echo $_POST['txtAddr3'];}?></textarea>
					<br>
					<br>
					<label for="contact-name" class="htlfndr-required htlfndr-top-label">Area</label>
								<?php
									if(mysqli_num_rows($result1)>0)
									{
										echo"<select name=areaId id=areaId class=htlfndr-review-form-input onfocus=disp(this.value); onchange=disp(this.value);>";
										//echo"<select name=areaId id=areaId class=htlfndr-review-form-input>";
										echo"<option value=0 select>-----Select Area-----</option>";
										while($data=mysqli_fetch_assoc($result1))
										{
											echo"<option value=".$data['AreaId'].">".$data['AreaName']."</option>";
										}
										echo"</select>";	
									}
									else
									{
										echo "Something went Wrong";
									}
								?>	
						<br>
						<br>		
								<label id="cityName"></label> 
								<br>
								<br>
						<label for="select-state">Nearby:</label>
							<?php
									if(mysqli_num_rows($result3)>0)
									{
										echo"<select class=htlfndr-review-form-input id=select-state multiple name=nearby[]>";
										while($dataNearby=mysqli_fetch_assoc($result3))
										{
											echo"<option value=".$dataNearby['NearPlaceId'].">".$dataNearby['NearPlaceName']."</option>";
										}
										echo"</select>";	
									}
									else
									{
										echo "Something went Wrong";
									}
								?>	
							<h3 style="display: none;">	
							<script type="text/javascript">
							var eventHandler = function(name) {
								return function() {
									console.log(name, arguments);
									$('#log').append('<div><span class="name">' + name + '</span></div>');
								};
							};
							var $select = $('#select-state').selectize({
								create          : true,
								onChange        : eventHandler('onChange'),
								onItemAdd       : eventHandler('onItemAdd'),
								onItemRemove    : eventHandler('onItemRemove'),
								onOptionAdd     : eventHandler('onOptionAdd'),
								onOptionRemove  : eventHandler('onOptionRemove'),
								onDropdownOpen  : eventHandler('onDropdownOpen'),
								onDropdownClose : eventHandler('onDropdownClose'),
								onFocus         : eventHandler('onFocus'),
								onBlur          : eventHandler('onBlur'),
								onInitialize    : eventHandler('onInitialize'),
							});
							</script>
							</h3>			
					    <input type="button" value="Previous" class="btn-primary" onclick="show_prev('rules_details','bar3');">
					    <input type="button" class="btn-primary" value="Next" onclick="validatePhase3();">
  					</div>

			  <div id="qualification">
<!-- 			   					<button style="margin-left: 70%; border: 2px solid lightblue;  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);border-radius: 12px;" class="btn-primary" id="mapcheck">Address Verification</button>
								<br>
								<br>
								<br>
								<label for="contact-name" class="htlfndr-required htlfndr-top-label">Map Latitude</label>
								<input type="text" value="<?php if(isset($_POST['txtLatitude'])){ echo $_POST['txtLatitude'];}?>" name="txtLatitude" id="txtLatitude" style="height:40px;" class="htlfndr-review-form-input" required readonly>
	              				<br>
								<br>
	              				<label for="contact-name" class="htlfndr-required htlfndr-top-label">Map Longitude</label>
								<input type="text" value="<?php if(isset($_POST['txtLongitude'])){ echo $_POST['txtLongitude'];}?>" name="txtLongitude" id="txtLongitude" style="height:40px;" class="htlfndr-review-form-input" required readonly>
								<br>
								<br> -->
								<label for="contact-name" class="htlfndr-required htlfndr-top-label">Check-In Time</label>
								<input type="time" value="<?php if(isset($_POST['txtCheckIn'])){ echo $_POST['txtCheckIn'];}?>" name="txtCheckIn" id="txtCheckIn" style="height:40px;" class="htlfndr-review-form-input" required placeholder="ex:10:00" >
								<br>
								<br>
								<label for="contact-name" class="htlfndr-required htlfndr-top-label">Check-Out Time</label>
								<input type="time" value="<?php if(isset($_POST['txtCheckOut'])){ echo $_POST['txtCheckOut'];}?>" name="txtCheckOut" id="txtCheckOut" style="height:40px;" class="htlfndr-review-form-input" required  placeholder="ex:10:00">
								<br>
								<br>
	              				<label for="contact-name" class="htlfndr-required htlfndr-top-label">Can User Cancel ?</label>
								<br>
								<input type="radio" name="radioCancelable" id="htlfndr-review-radio-1" value="1" checked>Yes
	              				<input type="radio" name="radioCancelable" id="htlfndr-review-radio-2" value="0">No
	              				<br>
							 <input type="button" class="btn-primary" value="Previous" onclick="show_prev('test_details','bar4');">
							 <input type="button" class="btn-primary" value="Next" onclick="validatePhase4();">
	              							    
			  </div>
			  <div id="aminities">
			   					<label for="contact-name" class="htlfndr-required htlfndr-top-label">Aminities</label>
			   					<br>
	              				<br>
	              				<?php
									if(mysqli_num_rows($result2)>0)
									{
										while($data=mysqli_fetch_assoc($result2))
										{
											echo"<input type=checkbox name=aminities[] id=number class=htlfndr-review-form-input value=".$data['AminitiesId'].">&nbsp&nbsp&nbsp".$data['AminitiesName'];
											echo"<br>";
											echo"<br>";
										}	
									}
									else
									{
										echo "Something went Wrong";
									}
								?>
								<label for="contact-name" class="htlfndr-top-label">Add extra aminitie(s)</label>
							
							<span id="extra">
							</span>	
							<br>
			   				<button id="addOther"  class="btn-primary">Add Other</button>
								<br>
								<input type="button" class="btn-primary" value="Previous" onclick="show_prev('qualification','bar5');">
							 <input type="button" class="btn-primary" value="Next" onclick="show_next('aminities','image_details','bar6');">
	              							    
			  </div>
			<div id="image_details">
				<span id="demo">
	              			<label for="contact-name" class="htlfndr-required htlfndr-top-label">Images to Upload</label>
							<input type=file name='imageUpload[]' id='number' class='htlfndr-review-form-input' required>
							<br>
							<input type=file name='imageUpload[]' id='number' class='htlfndr-review-form-input' required>
							<br>
	              			</span>
							<button id="addImage"  class="btn-primary">Add More Image</button>
							<br>
							 <input type="button" class="btn-primary" value="Previous" onclick="show_prev('aminities','bar6');">
							<input type="submit" id="register"  name="register" value=" Register " class="btn-primary">
			</div> 
		</form>
	</div>

				</div>	 
				</section><!-- .container.htlfndr-top-destinations -->
			</main>
		<footer class="htlfndr-footer">
		<?php
				include 'footer.html';
			?>
		</div><!-- .htlfndr-wrapper -->
		<?php
			include 'footerlinks.html';
		?>
	</body>
</html>			
