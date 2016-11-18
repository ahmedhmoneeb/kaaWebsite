<html>
<head>
<title>Curpha IOT Dashboard</title>
	<meta charset="utf-8" />
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
function httpGet(theUrl)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    xmlHttp.send( null );
    return xmlHttp.responseText;
}

        i = 0;
		$(document).ready(function(){
			$('#button').on('click', function(){
				$(this).toggleClass('on');
                i++;
                if (i%2 == 0) httpGet("sendNotification.php?message=Off");
                else httpGet("sendNotification.php?message=On");
			});
		});

	</script>
</head>

<body>

<div id="leftDiv">
<h1>Sending Notifications </h1>
<form class="cf" method="GET" action="">
    <textarea name="message" type="text" id="input-message" placeholder="Message"></textarea>
    <input type="submit" value="Submit" id="input-submit">
</form>
</div>

<div id="centerDiv">
<form class="cf" method="GET" action="">
<h1> Configuration Testing </h1>
<input type="text" name="deviceName" placeholder="Device Name">  

<table>
<tr>
<td>Red</td>
<td>
<label class="switch">
  <input type="checkbox" name="red">
  <div class="slider round"></div>
</label>
</td>
</tr>

<tr>
<td>Green</td>
<td>
<label class="switch">
  <input type="checkbox" name="green">
  <div class="slider round"></div>
</label>
</td>
</tr>

<tr>
<td>Blue</td>
<td>
<label class="switch">
  </p><input type="checkbox" name="blue">
  <div class="slider round"></div>
</label>
</td>
</tr>
</table>
<input type="submit" value="Submit" id="input-submit">

</form>
</div>

<div id="rightDiv">

<h1>Garage Control</h1>
<form class="cf" method="GET" action="">
    <h3>Click to Open and click to Close</h3>
    <section>
		<a href="#" id="button">G</a>
		<span></span>
	</section>
</form>

</div>

</body>
</html>
