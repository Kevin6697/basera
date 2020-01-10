function validatePhase1()
		{
			var firstName=document.getElementById('fname');
			var lastName=document.getElementById('lname');
			var basicPrice=document.getElementById('basicPrice');
			var pricePerson=document.getElementById('pricePerson');
			var bedrooms=document.getElementById('bedrooms');
			var bathrooms=document.getElementById('bathrooms');
			var status=true;
			if(firstName.value=="")
			{
				alert("House Name  Required");
				status=false;
			}
			if(lastName.value=="")
			{
				alert("No. of Guest Required");
				status=false;
			}
			if(basicPrice.value=="")
			{
				alert("Basic Price Required");	
				status=false;
			}
			if(basicPrice.value!="")
			{
				if(basicPrice.value<=499)
				{

					alert("Basic Price Should be greater than 500");	
					status=false;
				}	
			}
			
			if(pricePerson.value=="")
			{
				alert("Price Per Person Required");
				status=false;
			}
			if(pricePerson.value!="")
			{
				if(pricePerson.value<=49)
				{

					alert("Price Per Person Should be greater than 50");	
					status=false;
				}	
			}
			if(bedrooms.value=="")
			{
				alert("No. Of Bedrooms Required");
				status=false;
			}
			if(bedrooms.value!="")
			{
				if(bedrooms.value>11)
				{
					alert("Number of Bedrooms Should be less than 10");	
					status=false;
				}
				if(bedrooms.value<0)
				{
					alert("Number of Bedrooms Should be greater than 1");	
					status=false;
				}	
			}
			if(bathrooms.value=="")
			{
				alert("No. Of Bathrooms Required");
				status=false;
			}
			if(bathrooms.value!="")
			{
				if(bathrooms.value>11)
				{
					alert("Number of Bathrooms Should be less than 10");	
					status=false;
				}
				if(bathrooms.value<0)
				{
					alert("Number of Bathrooms Should be greater than 1");	
					status=false;
				}	
			}
			if(status)
			{
				show_next('account_details','user_details','bar1');	
			}
			
}
function validatePhase2()
{
	var status=true;
	var houseDescription=document.getElementById('description1');
	if(houseDescription.value=="")
	{
		alert("House Description1 Required");
		status=false;
	}
	if(status)
	{
		show_next('user_details','rules_details','bar2');
	}
}
function validatePhase3()
{
	var status=true;
	var addressLine1=document.getElementById('txtAddr1');
	var areaId=document.getElementById('areaId');
	if(addressLine1.value=="")
	{
		alert("Address Line1 Required");
		status=false;
	}
	if(areaId.value=="0")
	{
		alert("Please select Area");
		status=false;
	}
	
	if(status)
	{
		show_next('test_details','qualification','bar4');
	}	
}
function validatePhase4()
{
	var status=true;
	var txtCheckIn=document.getElementById('txtCheckIn');
	var txtCheckOut=document.getElementById('txtCheckOut');
	if(txtCheckIn.value=="")
	{
		alert("Check-In Time Required");
		status=false;
	}
	if(txtCheckOut.value=="")
	{
		alert("Check-Out Time Required");
		status=false;
	}
	if(status)
	{
		show_next('qualification','aminities','bar5')
	}	
}