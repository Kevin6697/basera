function show_next(id,nextid,bar)
{
    document.getElementById("account_details").style.display="none";
    document.getElementById("user_details").style.display="none";
    document.getElementById("nearby_details").style.display="none";
    document.getElementById("rules_details").style.display="none"; 
    document.getElementById("test_details").style.display="none";
    document.getElementById("qualification").style.display="none";
    document.getElementById("aminities").style.display="none";
    document.getElementById("image_details").style.display="none";
    $("#"+nextid).fadeIn();
    document.getElementById(bar).style.backgroundColor="#1a1c28";

}

function show_prev(previd,bar)
{
  document.getElementById("account_details").style.display="none";
  document.getElementById("user_details").style.display="none";
  document.getElementById("nearby_details").style.display="none";
  document.getElementById("rules_details").style.display="none";
  document.getElementById("test_details").style.display="none";
  document.getElementById("qualification").style.display="none";
 document.getElementById("aminities").style.display="none";
  document.getElementById("image_details").style.display="none";
  $("#"+previd).fadeIn();
  document.getElementById(bar).style.backgroundColor="#D8D8D8";
}
