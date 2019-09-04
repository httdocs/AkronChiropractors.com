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
<form enctype="multipart/form-data" action="uploadlogo.php" method="POST">
<table align="center" style="border-radius:25px; box-shadow: 0px 0px 10px 0px #888888; background-color: #fefef7; border=1px; width: 400px; height: 250px; padding: 10px;">
<tr>
<td style="text-align: center; vertical-align: top;">
<span style="font-family:arial,helvetica,sans-serif; color: #336699; font-size: 14px;">
<p style="text-align: center;"><strong>Important:</strong></p>
<p style="text-align: left;">Your Logo image must be named <strong>exactly</strong> the same as the file being replaced (all lower case) and should be proportionally square. 37px by 37px works best.</p>
<p style="text-align: center;">
Choose File: <input name="userfile" type="file" />
</p>
</span>
</td>
</tr>
<tr>
<td style="border-radius:20px; text-align: center;" bgcolor="#006699">
<input type="submit" value="Upload File" />
</td>
</tr>
</table>
</form>
</body>
</html>




