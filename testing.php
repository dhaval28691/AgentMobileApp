<!DOCTYPE html>
<script>
function baseurl()
{
var pathArray = window.location.href.split( '/' );
var protocol = pathArray[0];
var host = pathArray[2];
var hostname = pathArray[3];
//var dir = pathArray[4];
//alert(dir);
alert(hostname);
////////////////to update in thatco dynamically
if(hostname=="AgentMobileApp")
{

hostname+="/property";
}
else
{
hostname=hostname;
}
////////////////

var url = protocol + '//' + host + '/' +hostname;
return url;
}
</script>
<script>
function testing()
{
 //var a = baseurl()+"/WS/p_request.php?action=getpostproperty";
 //alert(a);
  var b =  '<?php echo $_SERVER['SERVER_NAME'];?>';
  alert(b);
}

</script>


<html>
<body onload="testing();">

<h1>My First Heading</h1>

<p>My first paragraph.</p>

</body>
</html>