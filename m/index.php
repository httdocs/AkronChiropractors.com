<!DOCTYPE html>
<html>
<head>
	<?php include '../includes/mobileheader.txt'; ?>
	 <!-- player skin -->
   <link rel="stylesheet" type="text/css" href="../video/skin/minimalist.css">
   <!-- include flowplayer -->
   <script type="text/javascript" src="../video/flowplayer.min.js"></script>
</head>
<body>
<div style="text-align: center; background-image:url('../images/mobile/<?php include '../custom/text_files/10.txt'; ?>/mobile_bg.jpg'); background-repeat:repeat-x; padding:10px"><img class="noborder" height="37" width="37" src="../images/logos/<?php include '../custom/text_files/logo.txt'; ?>"><br><span style="font-size: 18px; font-family: arial,helvetica,sans-serif; color: #ffffff; text-align: center; text-shadow: black 0.1em 0.1em 0.2em"><strong><?php include("../custom/text_files/4.txt"); ?></strong></span></div>
<div style="background-color:#3D4B55; height:5px;">&nbsp;</div>
	<section id="slider">
		<h2><strong>Get Answers</strong></h2>
		<ul class="slides">
			<li><div class="flowplayer is-splash" style="background:#777 url(../video/splashmobile.jpg) no-repeat;">
<video>
<source type="video/mp4" src="../video/video.mp4">
</video>
</div>
</li>
		</ul>
	</section>

	<nav>
		<ul data-role="listview">
			<li><a href="freeguide.php">Download Free Guide</a></li>
			<li><a href="about.php">About</a></li>
			<li><a href="contact.php">Contact Info</a></li>
		</ul>
	</nav>
		<section id="social">
<p style="text-align: center">
<a href="<?php include '../custom/text_files/18.txt'; ?>" target="_blank"><img alt="" src="../images/social/<?php include '../custom/text_files/17.txt'; ?>/yt.png" class="noborder"></a>
<a href="<?php include '../custom/text_files/12.txt'; ?>" target="_blank"><img alt="" src="../images/social/<?php include '../custom/text_files/11.txt'; ?>/gplus.png" class="noborder"></a>
<a href="<?php include '../custom/text_files/14.txt'; ?>" target="_blank"><img alt="" src="../images/social/<?php include '../custom/text_files/13.txt'; ?>/fb.png" class="noborder"></a>
<a href="<?php include '../custom/text_files/16.txt'; ?>" target="_blank"><img alt="" src="../images/social/<?php include '../custom/text_files/15.txt'; ?>/t.png" class="noborder"></a>
</p>
	</section>

	<footer data-role="footer">
		<p><img class="noborder" height="25" width="25" src="../images/logos/<?php include '../custom/text_files/logo.txt'; ?>">&nbsp;<span style="font-size: 14px; font-family: arial,helvetica,sans-serif; color: #336699;"><strong><?php include("../custom/text_files/4.txt"); ?></strong></span></p>
	</footer>
</body>
</html>