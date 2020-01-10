<?php
	session_start();
	require_once 'Host.php';
	$host = new HostController();
	if(isset($_POST['register']))
	{
		$status1=$host->updateHouseDetails();
		if($status1=="Success")
		{
				$status2=$host->updateAminitiesForHouse();
				if($status2=="Success")
				{
					$status3=$host->imageUpdateForHouse();
					if($status3=="Success")
					{
						$status4=$host->NearByUpdateForHouse();
						if($status4=="Success")
						{
							$success="Success";
						}
						else
						{
							$error=$status4;
						}
					}
					else
					{
						$error=$status3;
					}
				}
				else
				{
					$error=$status2;
				}
		}
		else
		{
			$error=$status1;
		}
	}
	if(isset($_GET['id']))
	{
		$result=$host->viewParticularHouse($_GET['id']);
			
	}
	else
	{
		$result=$host->viewParticularHouse($_POST['txtHouseId']);
	}
		$result1=$host->areaFetch();
		$result2=$host->aminitiesFetch(0);
		$resultNearBy=$host->nearbyFetch(0);
	
	// print_r($result);
	while ($data=mysqli_fetch_assoc($result)) {
		$result3=$host->aminitiesFetch($data['HouseId']);
		$result4=$host->imageFetch($data['HouseId'],'Particular');
		$result5=$host->nearbyFetch($data['HouseId']);
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
	<script type="text/javascript">
		$(document).ready(function(){
			$(".demo").click(function(){
				$("#areaId").focus();
			});
			$(".deleteimage").click(function(){
				var deleteId=$(this).attr('id');
				var houseId=$("#txtHouseId").val();
				swal({
						title:"Delete",
						text: "Are you sure  you want to Delete this Image !",
						type: "warning",
						showCancelButton: true,
					    confirmButtonColor: '#DD6B55',
					    confirmButtonText: 'Yes, I am sure!',
					    cancelButtonText: "No, cancel it!",
					    closeOnConfirm: false,
    					closeOnCancel: true
					},
					  function(isConfirm){
					  	if(isConfirm)
					  	{
					  		$.get('commons.php',{operation1:'deleteImage',deleteId:deleteId},function(data)
							{
								if(data=="DeletedImage Deleted")
								{	
									swal({
											title:"Deleted Successfully!",
											type: "success"
										},
									  function(){
									    window.location.href = 'editHosueDetails.php?id='+houseId;
									});
								}
								else
								{
									swal({
											title:data,
											type: "error"
										});	
								}
							});		
					  	}
				});
			});
		});
	</script>
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
					    	if(isset($error))
					    	{
					    		echo $error;
					    	}
					    	if(isset($success))
					    	{
					    		?>	
						 			<script type="text/javascript">
									 window.location="demo.php";
									</script>
					<?php
					    	}
					    ?>
				<div id="wrapper">
				 <form action="<?php echo $_SERVER['PHP_SELF']?>" id="htlfndr-contact-form" method="post" enctype="multipart/form-data">
		
					<div id="account_details">
						
							<br>

   								<label for="contact-name" class="htlfndr-required htlfndr-top-label">House Name</label>
   								<input type="hidden" value="<?php echo $data['HouseId'];?>"  class="htlfndr-review-form-input"  name="txtHouseId" id="txtHouseId">
								<input type="text" placeholder="" value="<?php if(isset($_POST['txtHouseName'])){ echo $_POST['txtHouseName'];}else{ echo $data['HouseName'];}?>" id="fname" class="htlfndr-review-form-input" required name="txtHouseName">
								<br>
								<br>
    							<label for="contact-name" class="htlfndr-required htlfndr-top-label">No. of Guest Allowed</label>
    							<input type="number" min=1 max=10 placeholder="1" id="lname" value="<?php if(isset($_POST['txtGuest'])){ echo $_POST['txtGuest'];}else{ echo $data['NoofAllowedGuest'];}?>" class="htlfndr-review-form-input"  required name="txtGuest" >
								<br>
								<br>
								<label for="contact-name" class="htlfndr-required htlfndr-top-label">Basic House Price</label>
								<input type="number" name="txtBasicPrice" min="500" id="basicPrice" class="htlfndr-review-form-input" value="<?php if(isset($_POST['txtBasicPrice'])){ echo $_POST['txtBasicPrice'];}else{ echo $data['HouseBasePrice'];}?>" required placeholder="1000">
								<br>
								<br>
	              				<label for="contact-name" class="htlfndr-required htlfndr-top-label">Price Per Person</label>
								<input type="number" name="txtPrice" min="50" id="pricePerson" class="htlfndr-review-form-input" value="<?php if(isset($_POST['txtPrice'])){ echo $_POST['txtPrice'];}else{ echo $data['HousePricePerPerson'];}?>" required placeholder="1000">
								<br>
								<br>
								<label for="contact-name" class="htlfndr-required htlfndr-top-label">Number of Bedrooms</label>
								<input type="number" name="txtBedrooms" id="bedrooms" class="htlfndr-review-form-input" required placeholder="5"  min=1 max=10 value="<?php if(isset($_POST['txtBedrooms'])){ echo $_POST['txtBedrooms'];}else{ echo $data['NoofBedrooms'];}?>" >
	              				<br>
								<br>
	              				<label for="contact-name" class="htlfndr-required htlfndr-top-label">Number of Bathrooms</label>
	              				<input type="number" name="txtBathrooms" id="bathrooms" class="htlfndr-review-form-input" required placeholder="2"  min=1 max=10  value="<?php if(isset($_POST['txtBathrooms'])){ echo $_POST['txtBathrooms'];}else{ echo $data['NoofBathrooms'];}?>">
	              	
					    <br>
					    <input type="button" value="Next" class="btn-primary" onclick="validatePhase1();">
						    
					  </div>
					  <div id="user_details">
					  			<label for="contact-name" class="htlfndr-required htlfndr-top-label">House Description</label>
								<textarea name="txtDesc1"  id="description1" class="htlfndr-review-form-input" rows=5 required placeholder=""><?php if(isset($_POST['txtDesc1']))
								{ echo $_POST['txtDesc1'];}else{ echo $data['HouseDescription1'];}?></textarea>
								<br>
								<br>
								<label for="contact-name" class="htlfndr-top-label">House Description</label>
								<input type="hidden" name="txtDesc2Detailed" value=<?php echo  $data['HouseDescription2'];?>>
								<textarea name="txtDesc2"  id="description2" class="htlfndr-review-form-input" rows=5  placeholder=""><?php if(isset($_POST['txtDesc2'])){ echo $_POST['txtDesc2'];}?></textarea>
							<br>
							<span style="color:red">If you don't want to specify any value please enter "NULL" as a data.
	    					<br>
	    					"-"specifies that value will remain as it is.
	    					</span>
	    					<br>
							<input type="button" value="Previous" class="btn-primary" onclick="show_prev('account_details','bar1');">
						    <input type="button" value="Next" class="btn-primary" onclick="validatePhase2();">
					 </div>
					 <div id="nearby_details">
					 	
					 </div>
					 <div id="rules_details">
					  			<label for="contact-name" class="htlfndr-top-label">Extra Rules you want Customer to follow 1 </label>
								<input type="hidden" name="txtRule1Detailed" value=<?php echo  $data['CustomRules1'];?>>
								<textarea name="txtRules1" id="number" class="htlfndr-review-form-input" maxlength="255" rows=5  placeholder="Max 255 Characters"><?php if(isset($_POST['txtRules1']))
								{ echo $_POST['txtRules1'];}elseif($data['CustomRules1']=="NULL"){ echo "-";}else{echo $data['CustomRules1'];}?></textarea>
								<br>
								<br>
								<label for="contact-name" class="htlfndr-top-label">Extra Rules you want Customer to follow 2 </label>
								<textarea name="txtRules2" id="number" class="htlfndr-review-form-input" maxlength="255" rows=5  placeholder="Max 255 Characters"><?php if(isset($_POST['txtRules2']))
								{ echo $_POST['txtRules2'];}elseif($data['CustomRules2']=="NULL"){ echo "-";}else{echo $data['CustomRules2'];}?></textarea>
	              	
	    					<br>
	    					<span style="color:red">If you don't want to specify any value please enter "NULL" as a data.
	    					<br>
	    					"-"specifies that value will remain as it is.
	    					</span>
	    					<br>
							<input type="button" value="Previous" class="btn-primary" onclick="show_prev('user_details','bar2');">
						    <input type="button" value="Next" class="btn-primary" onclick="show_next('rules_details','test_details','bar3');">
					 </div>
					  <div id="test_details">
					 	  <label for="contact-name" class="htlfndr-required htlfndr-top-label">House Address Line1</label>
					<?php
						if($data['IsHouseVerified']==1)
						{
							echo"<textarea name=txtAddr1 id=txtAddr1 class=htlfndr-review-form-input rows=3 readonly>".$data['HouseAddressLine1']."</textarea>";
						}
						else
						{
							echo"<textarea name=txtAddr1 id=txtAddr1 class=htlfndr-review-form-input rows=3 required>"; if(isset($_POST['txtAddr1'])){ echo $_POST['txtAddr1'];}else{echo $data['HouseAddressLine1'];}echo"</textarea>";
						}
					?>
					<br>
					<br>
					<label for="contact-name" class="htlfndr-top-label">House Address Line2</label>
					<input type="hidden" name="txtAddr2Detailed" value=<?php echo  $data['HouseAddressLine2'];?>>
					<?php
						if($data['IsHouseVerified']==1)
						{
							echo"<textarea name=txtAddr2 id=txtAddr2 class=htlfndr-review-form-input rows=3 readonly>";if(isset($_POST['txtAddr2'])){ echo $_POST['txtAddr2'];}elseif($data['HouseAddressLine2']=="NULL"){ echo "-";}else{echo $data['HouseAddressLine2'];}
							echo"</textarea>";
						}
						else
						{
							echo"<textarea name=txtAddr2 id=txtAddr1 class=htlfndr-review-form-input rows=3 required>";  if(isset($_POST['txtAddr2'])){ echo $_POST['txtAddr2'];}elseif($data['HouseAddressLine2']=="NULL"){echo "-";}else{echo $data['HouseAddressLine2'];}echo"</textarea>";
						}
					?>
					<br>
					<br>			
					<label for="contact-name" class="htlfndr-top-label">House Address Line3</label>
					<input type="hidden" name="txtAddr3Detailed" value=<?php echo  $data['HouseAddressLine3'];?>>
					<?php
						if($data['IsHouseVerified']==1)
						{
							echo"<textarea name=txtAddr3 id=txtAddr1 class=htlfndr-review-form-input rows=3 readonly>";if(isset($_POST['txtAddr3'])){ echo $_POST['txtAddr3'];}elseif($data['HouseAddressLine3']=="NULL"){echo "-";}else{echo $data['HouseAddressLine3'];}
							echo"</textarea>";
						}
						else
						{
							echo"<textarea name=txtAddr3 id=txtAddr1 class=htlfndr-review-form-input rows=3 required>";  if(isset($_POST['txtAddr3'])){ echo $_POST['txtAddr3'];}elseif($data['HouseAddressLine3']=="NULL"){echo "-";}else{echo $data['HouseAddressLine3'];}echo"</textarea>";
						}
					?>
					<br>
					<br>
					<label for="contact-name" class="htlfndr-required htlfndr-top-label">Area</label>
							<?php
								if($data['IsHouseVerified']==1)
								{
										echo"<select name=areaId id=areaId class=htlfndr-review-form-input onfocus=disp(this.value); onchange=disp(this.value)>";
										
										while($dataArea=mysqli_fetch_assoc($result1))
										{
											if($dataArea['AreaId']==$data['AreaId'])
											{
												echo"<option value=".$dataArea['AreaId'].">".$dataArea['AreaName']."</option>";	
											}
											
										}
										echo"</select>";	
								}
								else
								{
									if(mysqli_num_rows($result1)>0)
									{
										echo"<select name=areaId id=areaId class=htlfndr-review-form-input onfocus=disp(this.value); onchange=disp(this.value)>";
										//echo"<select name=areaId id=areaId class=htlfndr-review-form-input>";
										
										while($dataArea=mysqli_fetch_assoc($result1))
										{
											if($dataArea['AreaId']==$data['AreaId'])
											{
												echo"<option selected value=".$dataArea['AreaId'].">".$dataArea['AreaName']."</option>";
											}
											else
											{
												echo"<option value=".$dataArea['AreaId'].">".$dataArea['AreaName']."</option>";
											}
											
										}
										echo"</select>";	
									}
									else
									{
										echo "Something went Wrong";
									}
								}	
							?>	
						<br>
						<br>		
								<label id="cityName"></label> 
								<br>
							<label for="select-state">Nearby:</label>
							<?php
								if($data['IsHouseVerified']==1)
								{
									$tmpnearbydata=array();
		              				while($tmpNearByResult=mysqli_fetch_assoc($result5))
										{
											array_push($tmpnearbydata,$tmpNearByResult['NearPlaceName']);
										}
										if(mysqli_num_rows($resultNearBy)>0)
										{
											echo"<select class=htlfndr-review-form-input id=select-state multiple name=nearby[] disabled >";
											while($dataNearby=mysqli_fetch_assoc($resultNearBy))
											{

												if(in_array($dataNearby['NearPlaceName'], $tmpnearbydata))
												{

													echo"<option selected value=".$dataNearby['NearPlaceId'].">".$dataNearby['NearPlaceName']."</option>";	
												}
												else
												{
													echo"<option value=".$dataNearby['NearPlaceId'].">".$dataNearby['NearPlaceName']."</option>";
												}
												
											}
											echo"</select>";	
								        }
								}
								else
								{
									$tmpnearbydata=array();
		              				while($tmpNearByResult=mysqli_fetch_assoc($result5))
										{
											array_push($tmpnearbydata,$tmpNearByResult['NearPlaceName']);
										}
										if(mysqli_num_rows($resultNearBy)>0)
										{
											echo"<select class=htlfndr-review-form-input id=select-state multiple name=nearby[] >";
											while($dataNearby=mysqli_fetch_assoc($resultNearBy))
											{

												if(in_array($dataNearby['NearPlaceName'], $tmpnearbydata))
												{

													echo"<option selected value=".$dataNearby['NearPlaceId'].">".$dataNearby['NearPlaceName']."</option>";	
												}
												else
												{
													echo"<option value=".$dataNearby['NearPlaceId'].">".$dataNearby['NearPlaceName']."</option>";
												}
												
											}
											echo"</select>";	
								        }
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
						
					<?php
			   			if($data['IsHouseVerified']==1)
						{
							echo"<span style=color:black>Your Address has been Verified Successfully";
						}
						else
						{
							echo"<span style=color:red>If you don't want to specify any value please enter \"NULL\" as a data
						<br>
	    					\"-\"specifies that value will remain as it is.	
						</span>";
						}
					?>	
					<br><br>
					    <input type="button" value="Previous" class="btn-primary" onclick="show_prev('rules_details','bar3');">
					    <input type="button" class="btn-primary" value="Next" onclick="validatePhase3();">
  					</div>

			  <div id="qualification">
<!-- 			   							   		<?php
			   // 		if($data['IsHouseVerified']==1)
						// {
						// 	echo"<button style='margin-left: 70%; border: 2px solid lightblue;  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);border-radius: 12px;' class=btn-primary id=mapcheck disabled=true>Address Verification</button>";
						// }
						// else
						// {
						// 	echo"<button style='margin-left: 70%; border: 2px solid lightblue;  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);border-radius: 12px;' class=btn-primary id=mapcheck >Address Verification</button>";	
						// }	
			   		?>
					<!-- 			<br>
								<br>
								<br>
								<label for="contact-name" class="htlfndr-required htlfndr-top-label">Map Latitude</label>
								<input type="text" name="txtLatitude" value="<?php if(isset($_POST['txtLatitude'])){ echo $_POST['txtLatitude']; }else{echo $data['MapLatitude'];}?>" id="txtLatitude" style="height:40px;" class="htlfndr-review-form-input" required readonly>
	              				<br>
								<br>
	              				<label for="contact-name" class="htlfndr-required htlfndr-top-label">Map Longitude</label>
								<input type="text" value="<?php if(isset($_POST['txtLongitude'])){ echo $_POST['txtLongitude']; }else{echo $data['MapLongitude'];}?>" name="txtLongitude" id="txtLongitude" style="height:40px;" class="htlfndr-review-form-input" required readonly> -->
								<label for="contact-name" class="htlfndr-required htlfndr-top-label">Check-In Time</label>
								<input type="time" value="<?php if(isset($_POST['txtCheckIn'])){ echo $_POST['txtCheckIn'];}else{echo $data['CheckIn'];}?>" name="txtCheckIn" id="txtCheckIn" style="height:40px;" class="htlfndr-review-form-input" required placeholder="ex:10:00" >
								<br>
								<br>
								<label for="contact-name" class="htlfndr-required htlfndr-top-label">Check-Out Time</label>
								<input type="time" value="<?php if(isset($_POST['txtCheckOut'])){ echo $_POST['txtCheckOut'];}else{echo $data['CheckOut'];}?>" name="txtCheckOut" id="txtCheckOut" style="height:40px;" class="htlfndr-review-form-input" required placeholder="ex:10:00">
								<br>
								<br>
	              				<label for="contact-name" class="htlfndr-required htlfndr-top-label">Can User Cancel ?</label>
								<br>
								<?php
									if($data['IsCancellable']==1)
									{
										echo"<input type=radio name=radioCancelable id=htlfndr-review-radio-1 value=1 checked>Yes";
										echo"<input type=radio name=radioCancelable id=htlfndr-review-radio-2 value=0>No";		
									}
									else
									{
										echo"<input type=radio name=radioCancelable id=htlfndr-review-radio-1 value=1>Yes";
										echo"<input type=radio name=radioCancelable id=htlfndr-review-radio-2 value=0 checked>No";	
									}
								?>
	              				<br>
							 <input type="button" class="btn-primary" value="Previous" onclick="show_prev('test_details','bar4');">
							 <input type="button" class="btn-primary" value="Next" onclick="validatePhase4();">
	              							    
			  </div>
			  <div id="aminities">
			   					<label for="contact-name" class="htlfndr-required htlfndr-top-label">Aminities</label>
			   					<br>
	              				<br>
	              				<?php
	              				$tmpdata=array();
	              				while($tmpAminitiesResult=mysqli_fetch_assoc($result3))
									{
										array_push($tmpdata,$tmpAminitiesResult['AminitiesName']);
									}
									if(mysqli_num_rows($result2)>0)
									{
										while($dataAminities=mysqli_fetch_assoc($result2))
										{
											if(in_array($dataAminities['AminitiesName'], $tmpdata))
											{

													echo"<input type=checkbox name=aminities[]  id=number checked class=htlfndr-review-form-input value=".$dataAminities['AminitiesId'].">&nbsp&nbsp&nbsp".$dataAminities['AminitiesName']."<br><br>";

											}
											else
											{

													echo"<input type=checkbox name=aminities[]  id=number class=htlfndr-review-form-input value=".$dataAminities['AminitiesId'].">&nbsp&nbsp&nbsp".$dataAminities['AminitiesName']."<br><br>";

											}
											
										}
											echo"<br>";
											echo"<br>";
											
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
	              			<label for="contact-name" class="htlfndr-top-label">Upload Image to Update</label>
	              			<br>
					<?php 
					$numRows=mysqli_num_rows($result4);
					// $inc=0;
					echo"<input type=hidden name=numRows value=".$numRows.">";
					while ($dataImage=mysqli_fetch_assoc($result4)) {
						echo"<img src=../Uploads/HouseDetails/".$dataImage['Image']." alt=House height=200 width=200  id=".$dataImage['HIId']."/>";
						echo "<input type=hidden name='inc[]' id='number' class='htlfndr-review-form-input' value=".$dataImage['Image'].">
							<input type=file name='imageUpload1[]' class='htlfndr-review-form-input'>
							<input class=deleteimage type=button value= Delete  id=". $dataImage['HIId']." />
							<br>
							<br>
							<br>
							";

						// $inc++;	
					}

				?>
				</span>
							<button id="addImage" class="btn-primary">Add More Image</button>
							<br>
				
							<br>
							 <input type="button" class="btn-primary" value="Previous" onclick="show_prev('aminities','bar6');">
							<input type="submit" id="register"  name="register" value=" Update " class="btn-primary">
			</div> 
		</form>
	</div>
	<?php
		}

	?>
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
