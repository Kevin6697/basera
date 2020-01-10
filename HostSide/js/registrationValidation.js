$(document).ready(function()
{
	$("#fname").blur(function(){
	var fname=$("#fname").val();
		var check =/^[A-Za-z]+$/;
		if(!check.test(fname))
		{
			$("#p1").show();
			$("#fname").focus();
			$("#submit").hide();
		}
		else
		{
		$("#p1").hide();
		$("#submit").show();
		}
	
});
$("#lname").blur(function(){
		var lname=$("#lname").val();
		var check =/^[A-Za-z]+$/;
		if(!check.test(lname))
		{
			$("#p2").show();
			$("#lname").focus();
			$("#submit").hide();
		}
		else
		{
		$("#p2").hide();
		$("#submit").show();
		}
	});

$("#number").blur(function(){
		var number=$("#number").val();
		var check =/^\(?([1-9]{1}[0-9]{2})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
		if(!check.test(number))
		{
			$("#p3").show();
			$("#number").focus();
			$("#submit").hide();
		}
		else
		{
		$("#p3").hide();
		$("#submit").show();
		}
	
});
$("#email").blur(function(){
	var email=$("#email").val();
	var check =/^([\w-\.]+@([\A-Za-z-]+\.)+[\A-Za-z-]{2,4})?$/;
	if(!check.test(email))
	{
	$("#p4").show();
	$("#email").focus();
	$("#submit").hide();
	}
	else
	{
	$("#p4").hide();
	$("#submit").show();
	}

});

$('#password-field').blur(function(){
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
$('#tc').change(function(){
	var checked =$(this);
	if(checked.is(':checked'))
	{
		$("#termsandcondtionerror").hide();
		$("#submit").show();
	}
	else
	{
		$("#termsandcondtionerror").show();
		$("#submit").hide();
	}
});
	
});