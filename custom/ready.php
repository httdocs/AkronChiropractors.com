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

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

</head>
<body bgcolor="#e9e9e9">
<table width="900" align="center" style="background-color: #fefef7; border-radius:25px; box-shadow: 0px 0px 10px 0px #888888; padding:15px;">
<tr>
<p>&nbsp;</p>
<p>&nbsp;</p>
<td style="background-color: #fefef7; vertical-align: top; padding: 0px;">
	<div style="padding: 10px; border-radius:15px; background:url(../colors/<?php include 'text_files/10.txt'; ?>/main_mid.jpg) repeat-x; height:80px;"><img src="../images/thumbs_up.png" border="0"></div>
	<p>&nbsp;</p>
<span style="font-family:trebuchet ms,helvetica,sans-serif;">
<h2 style="text-align: center; font-size: 28px; color: #993333; text-shadow: 2px 2px 2px rgba(0,0,0,0.3);">Your Website is Ready!</h2>
<p>&nbsp;</p>
<p align="center"><span style="font-family: trebuchet ms,helvetica,sans-serif; font-size: 20px;"><a href="../index.php">View Your Website</a></span></p>	
<p>&nbsp;</p>
<p align="center"><span style="font-family: trebuchet ms,helvetica,sans-serif; font-size: 20px;"><i>or...</i></span></p>	
<p>&nbsp;</p>
<ul>
<blockquote><li><span style="font-family: trebuchet ms,helvetica,sans-serif; font-size: 20px;"><a href="form_featured_sites.php">Add a "Featured Websites" Section to the Bottom of the Home Page</a></span></li></blockquote>
<blockquote><li><span style="font-family: trebuchet ms,helvetica,sans-serif; font-size: 20px;"><a href="form_titles.php">Edit Main Page Titles, Search Engine Meta Description and Keywords</a></span></li></blockquote>
</ul>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div style="padding: 10px; border-radius:15px; text-align: center; background:url(../colors/<?php include 'text_files/10.txt'; ?>/back_mid.jpg) repeat-x; height:40px;"><a href="form.php"><span style="font-size: 20px; color: #ffffff;">Go Back to the Dashboard</span></a>&nbsp;<img src="../images/curvedarrow.png" border="0"></div>
</span>
</td>
</tr>
</table>	
</body>
</html>


