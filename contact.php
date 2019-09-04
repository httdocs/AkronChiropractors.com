<?php
// OPTIONS - PLEASE CONFIGURE THESE BEFORE USE!

$yourEmail = file_get_contents('custom/text_files/9.txt'); // the email address you wish to receive these mails through
$yourWebsite = "Website Contact Form"; // the name of your website
$thanksPage = ''; // URL to 'thanks for sending mail' page; leave empty to keep message on the same page 
$maxPoints = 4; // max points a person can hit before it refuses to submit - recommend 4
$requiredFields = "name,email,comments"; // names of the fields you'd like to be required as a minimum, separate each field with a comma


// DO NOT EDIT BELOW HERE
$error_msg = array();
$result = null;

$requiredFields = explode(",", $requiredFields);

function clean($data) {
	$data = trim(stripslashes(strip_tags($data)));
	return $data;
}
function isBot() {
	$bots = array("Indy", "Blaiz", "Java", "libwww-perl", "Python", "OutfoxBot", "User-Agent", "PycURL", "AlphaServer", "T8Abot", "Syntryx", "WinHttp", "WebBandit", "nicebot", "Teoma", "alexa", "froogle", "inktomi", "looksmart", "URL_Spider_SQL", "Firefly", "NationalDirectory", "Ask Jeeves", "TECNOSEEK", "InfoSeek", "WebFindBot", "girafabot", "crawler", "www.galaxy.com", "Googlebot", "Scooter", "Slurp", "appie", "FAST", "WebBug", "Spade", "ZyBorg", "rabaz");

	foreach ($bots as $bot)
		if (stripos($_SERVER['HTTP_USER_AGENT'], $bot) !== false)
			return true;

	if (empty($_SERVER['HTTP_USER_AGENT']) || $_SERVER['HTTP_USER_AGENT'] == " ")
		return true;
	
	return false;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (isBot() !== false)
		$error_msg[] = "No bots please! UA reported as: ".$_SERVER['HTTP_USER_AGENT'];
		
	// lets check a few things - not enough to trigger an error on their own, but worth assigning a spam score.. 
	// score quickly adds up therefore allowing genuine users with 'accidental' score through but cutting out real spam :)
	$points = (int)0;
	
	$badwords = array("adult", "beastial", "bestial", "blowjob", "clit", "cum", "cunilingus", "cunillingus", "cunnilingus", "cunt", "ejaculate", "fag", "felatio", "fellatio", "fuck", "fuk", "fuks", "gangbang", "gangbanged", "gangbangs", "hotsex", "hardcode", "jism", "jiz", "orgasim", "orgasims", "orgasm", "orgasms", "phonesex", "phuk", "phuq", "pussies", "pussy", "spunk", "xxx", "viagra", "phentermine", "tramadol", "adipex", "advai", "alprazolam", "ambien", "ambian", "amoxicillin", "antivert", "blackjack", "backgammon", "texas", "holdem", "poker", "carisoprodol", "ciara", "ciprofloxacin", "debt", "dating", "porn", "link=", "voyeur", "content-type", "bcc:", "cc:", "document.cookie", "onclick", "onload", "javascript");

	foreach ($badwords as $word)
		if (
			strpos(strtolower($_POST['comments']), $word) !== false || 
			strpos(strtolower($_POST['name']), $word) !== false
		)
			$points += 2;
	
	if (strpos($_POST['comments'], "http://") !== false || strpos($_POST['comments'], "www.") !== false)
		$points += 2;
	if (isset($_POST['nojs']))
		$points += 1;
	if (preg_match("/(<.*>)/i", $_POST['comments']))
		$points += 2;
	if (strlen($_POST['name']) < 3)
		$points += 1;
	if (strlen($_POST['comments']) < 15 || strlen($_POST['comments'] > 1500))
		$points += 2;
	if (preg_match("/[bcdfghjklmnpqrstvwxyz]{7,}/i", $_POST['comments']))
		$points += 1;
	// end score assignments

	foreach($requiredFields as $field) {
		trim($_POST[$field]);
		
		if (!isset($_POST[$field]) || empty($_POST[$field]) && array_pop($error_msg) != "Please fill in all the required fields and submit again.\r\n")
			$error_msg[] = "Please fill in all the required fields and submit again.";
	}

	if (!empty($_POST['name']) && !preg_match("/^[a-zA-Z-'\s]*$/", stripslashes($_POST['name'])))
		$error_msg[] = "The name field must not contain special characters.\r\n";
	if (!empty($_POST['email']) && !preg_match('/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])(([a-z0-9-])*([a-z0-9]))+' . '(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i', strtolower($_POST['email'])))
		$error_msg[] = "That is not a valid e-mail address.\r\n";
	if (!empty($_POST['url']) && !preg_match('/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(:(\d+))?\/?/i', $_POST['url']))
		$error_msg[] = "Invalid website url.\r\n";
	
	if ($error_msg == NULL && $points <= $maxPoints) {
		$subject = "Website Form Email";
		
		$message = "You received this e-mail message through your website: \n\n";
		foreach ($_POST as $key => $val) {
			if (is_array($val)) {
				foreach ($val as $subval) {
					$message .= ucwords($key) . ": " . clean($subval) . "\r\n";
				}
			} else {
				$message .= ucwords($key) . ": " . clean($val) . "\r\n";
			}
		}
		$message .= "\r\n";
		$message .= 'IP: '.$_SERVER['REMOTE_ADDR']."\r\n";
		$message .= 'Browser: '.$_SERVER['HTTP_USER_AGENT']."\r\n";
		$message .= 'Points: '.$points;

		if (strstr($_SERVER['SERVER_SOFTWARE'], "Win")) {
			$headers   = "From: $yourEmail\n";
			$headers  .= "Reply-To: {$_POST['email']}";
		} else {
			$headers   = "From: $yourWebsite <$yourEmail>\n";
			$headers  .= "Reply-To: {$_POST['email']}";
		}

		if (mail($yourEmail,$subject,$message,$headers)) {
			if (!empty($thanksPage)) {
				header("Location: $thanksPage");
				exit;
			} else {
				$result = 'Thank you. Your mail was successfully sent.';
				$disable = true;
			}
		} else {
			$error_msg[] = 'Your mail could not be sent this time. ['.$points.']';
		}
	} else {
		if (empty($error_msg))
			$error_msg[] = 'Your mail looks too much like spam, and could not be sent this time. ['.$points.']';
	}
}
function get_data($var) {
	if (isset($_POST[$var]))
		echo htmlspecialchars($_POST[$var]);
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include 'includes/title_and_desc.txt'; ?>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<style type="text/css">
BODY {margin: 0; background-color:#ffffff;}
#headerfill {background:url(colors/<?php include 'custom/text_files/10.txt'; ?>/header_fill.jpg) repeat-x; height:72px;}
#header {background:url(colors/<?php include 'custom/text_files/10.txt'; ?>/header.jpg) no-repeat; background-position:center 50%; height:72px;}
</style>
<link rel="stylesheet" type="text/css" href="style.css">
	
	<style type="text/css">
		p.error, p.success {
			font-weight: bold;
			padding: 10px;
			border: 1px solid;
		}
		p.error {
			background: #ffc0c0;
			color: #900;
		}
		p.success {
			background: #b3ff69;
			color: #4fa000;
		}
	</style>
</head>
<body>
<?php include 'includes/header.txt'; ?>
<div class="table-2">
   <div class="table-row-2">
   	      <div class="table-cell-2a">
<img class="noborder" alt="" height="272" src="images/edge_left.jpg" width="18">
</div>
<div class="table-cell-2b">
	<p>&nbsp;</p>
<h2 style="text-align: center"><span style="font-family: trebuchet ms,helvetica,sans-serif"><span style="color: #696969">Contact</span></span></h2>
<p>&nbsp;</p>
<?php include 'includes/businessbox.txt'; ?>
<p>
<!--
	Free PHP Mail Form v2.4.3 - Secure single-page PHP mail form for your website
	Copyright (c) Jem Turner 2007, 2008, 2010, 2011, 2012
	http://jemsmailform.com/

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	To read the GNU General Public License, see http://www.gnu.org/licenses/.
-->

<?php
if (!empty($error_msg)) {
	echo '<p class="error">ERROR: '. implode("<br />", $error_msg) . "</p>";
}
if ($result != NULL) {
	echo '<p class="success">'. $result . "</p>";
}
?>
<p>&nbsp;</p>
<h2 style="text-align: center"><span style="font-family: trebuchet ms,helvetica,sans-serif"><span style="color: #696969">Send Message</span></span></h2>
<form action="<?php echo basename(__FILE__); ?>" method="post">
<noscript>
		<p><input type="hidden" name="nojs" id="nojs" /></p>
</noscript>
<p>
<table align="center" border="0" cellpadding="5" cellspacing="0" style="width: 600px">
	<tbody>
		<tr>
			<td>&nbsp;</td>
			<td><input type="hidden" name="from_website" id="from_website" value="<?PHP echo $_SERVER['HTTP_HOST'] ?>" /></td>
		</tr>
		<tr>
			<td style="text-align: right; width: 100px"><label for="name">Name:</label></td>
			<td style="text-align: left; width: 500px"><input type="text" name="name" id="name" value="<?php get_data("name"); ?>" /></td>
		</tr>
		<tr>
			<td style="text-align: right; width: 100px"><label for="email">Email:</label></td>
			<td style="text-align: left; width: 500px"><input type="text" name="email" id="email" value="<?php get_data("email"); ?>" /></td>
		</tr>
		<tr>
			<td style="text-align: right; width: 100px"><label for="comments">Comments:</label></td>
			<td style="width: 500px"><textarea name="comments" id="comments" rows="5" cols="40"><?php get_data("comments"); ?></textarea></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;"><input type="submit" name="submit" id="submit" value="Send" <?php if (isset($disable) && $disable === true) echo ' disabled="disabled"'; ?> /></td>
		</tr>
	</tbody>
</table>
</p>
</form>
</p>
</div>
<div class="table-row-2">
<img class="noborder" alt="" height="272" src="images/edge_right.jpg" width="18">
</div>
</div>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div ID="footer">
<?php include 'includes/footerlinks.txt'; ?>
</div>
<?php include 'includes/smedia.txt'; ?>
</body>
</html>