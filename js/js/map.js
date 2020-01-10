function disp(str)
	{
			r = new XMLHttpRequest();
			r.open("GET","commons.php?area="+str,true);
			r.send();
			r.onreadystatechange=function()
			{
				if(r.readyState==4 && r.status==200)
				{
					$("#cityName").html(r.responseText);
				}
			}
	}

$(document).ready(function(){
		$("#addImage").click(function(){
			var newfield = '<input type=file name=imageUpload[] id=number class=htlfndr-review-form-input required><br>' ;
			$('#demo').append(newfield);
		});
		$("#addOther").click(function(){
			var newfield = '<br><input type=text name=extraAminities[] id=number class=htlfndr-review-form-input required><br>' ;
			$('#extra').append(newfield);
		});
		$("#mapcheck").click(function(){
			var txtaddr1=$("#txtAddr1").val();
			var txtaddr2=$("#txtAddr2").val();
			var txtaddr3=$("#txtAddr3").val();
			var area=$("#areaName").val();
			var city=$("#cityId").val();
			var state=$("#stateId").val();
			var geocoder = new google.maps.Geocoder();
			var demo="";
			if(txtaddr1!="" && area!="" && state!="")
			{
				demo=txtaddr1+",";
				if(area==undefined)
				{
					alert("Enter Valid Address");
					$("#areaId").focus();
				}
				else
				{
					if(txtaddr2!="" && txtaddr3=="")
					{
						demo=demo+txtaddr2+",";
					}
					else if(txtaddr3!="" &&  txtaddr2=="")
					{
						demo=demo+txtaddr3+",";
					} 
					else if(txtaddr3!="" &&  txtaddr2!="")
					{
						demo=demo+txtaddr2+","+txtaddr3+",";
					}
					demo=demo+area+","+city+","+state;
					alert(demo);
					var address = demo;
					geocoder.geocode( { 'address': address}, function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
					    var latitude = results[0].geometry.location.lat();
						var longitude = results[0].geometry.location.lng();
					    alert(latitude+" "+longitude);
					    $('#txtLatitude').val(latitude);
					    $('#txtLongitude').val(longitude);
					    } 
					    else
					    {
					    	alert("No such Address Found");
					    	// $("#areaId").focus();
					    	$('#txtLatitude').val("23.0362432");
					    	$('#txtLongitude').val("72.56029809999995");
					    }
					});

					}			
			}
			else
			{
				alert("Enter Valid Address");
				$("#txtAddr1").focus();
			}
		});	
	});	