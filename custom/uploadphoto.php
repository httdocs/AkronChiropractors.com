<?
// START SESSION
session_start();

// LOGGED IN?
if (!isset($_SESSION['basic_is_logged_in']) 
    || $_SESSION['basic_is_logged_in'] !== true) {

    // SORRY
    header('Location: index.php');
    exit;
}
?>
<html>
<body bgcolor="#e9e9e9">
<table align="center" style="border-radius:25px; box-shadow: 0px 0px 10px 0px #888888; background-color: #fefef7; border=1px; width: 400px; height: 250px; padding: 10px;">
	<tr>
		<td style="text-align: center; vertical-align: top;">
<span style="font-family:arial,helvetica,sans-serif; color: #336699; font-size: 20px;">
	<?php
$path = "../images/people/";
$path = $path . basename( $_FILES['userfile']['name']);
if(move_uploaded_file($_FILES['userfile']['tmp_name'], $path)) {
echo "Success uploading<br>". basename($_FILES['userfile']['name']);
} else{
echo "Error when uploading file.";
}
?>
<p>&nbsp;</p>
<span style="font-family:arial,helvetica,sans-serif; color: red; font-size: 20px;"><a href=javascript:window.close(); target=_top>Click To Close Window</a>
</span>
</span>
</td>
</tr>
</table>
</body>
</html>