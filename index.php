<?php




print <<<_HTML_
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Curpha</title>  
      <link rel="stylesheet" href="css/style.css">
</head>

<body>
<h1>Curpha IOT Control Dashboard</h1>
<table>
<tr>
<td>
  <h1>Sending Notifications </h1>
<form class="cf">
  <div class="half left cf">
    <h4>Notifications Should Appear HERE!</h4>

  </div>
  <div class="half right cf">
    <textarea name="message" type="text" id="input-message" placeholder="Message"></textarea>
    <input type="submit" value="Submit" id="input-submit">
  </div>  
  </td>
<td>
</form>
 
<form class="cf">
  <div class="half left cf">


  </div>
  <div class="half right cf">
    
  </div>  
</form>
</td>
</tr>
</table>
</body>
</html>
_HTML_;

?>
