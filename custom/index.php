<?php
//Set your username and password
$adminuser = "admin";
$adminpw = "ChangeThisPassword";
# version 2.0 #
// we must never forget to start the session
session_start();

$errorMessage = '';
if (isset($_POST['txtUserId']) && isset($_POST['txtPassword'])) {
	// check if the username and password combination is correct
	if ($_POST['txtUserId'] === $adminuser && $_POST['txtPassword'] === $adminpw) {
		// the username and password match, 
		// set the session
		$_SESSION['basic_is_logged_in'] = true;
		
		// after login we move to the main page
		header('Location: form.php');
		exit;
	} else {
		$errorMessage = 'Sorry, wrong username / password';
	}
}
?>
<html>
<head>
<title>Please Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body bgcolor="#e9e9e9">	
<?php
if ($errorMessage != '') {
?>
<p align="center"><strong><font color="#990000"><?php echo $errorMessage; ?></font></strong></p>
<?php
}
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table align="center" style="border-radius:25px; box-shadow: 0px 0px 10px 0px #888888; background-color: #fefef7; border=1px; width: 400px; height: 200px; padding: 10px;">
	<tr>
		<td>
<form action="" method="post" name="frmLogin" id="frmLogin">
  <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td style="font-family:trebuchet ms,helvetica,sans-serif; color: #336699; text-align:center;"><h2>Please Login</h2></td>
    </tr>
  </table>
  <table width="400" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
   <td style="font-family:trebuchet ms,helvetica,sans-serif; color: #336699; font-size: 14px; width: 150; text-align: right;">User:</td>
   <td><input name="txtUserId" type="text" id="txtUserId"></td>
  </tr>
  <tr>
   <td style="font-family:trebuchet ms,helvetica,sans-serif; color: #336699; font-size: 14px; width: 150; text-align: right;">Password:</td>
   <td><input name="txtPassword" type="password" id="txtPassword"></td>
  </tr>
    <tr><td>&nbsp;</td></tr>
  <tr>
   <td colspan="2" style="text-align:center; border-radius:10px;" bgcolor="#006699"><input name="btnLogin" type="submit" id="btnLogin" value="Login"></td>
  </tr>
 </table>
</form>
</td>
</tr>
</table>
</body>
</html>
