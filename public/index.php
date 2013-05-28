<?php

// Define various paths
define('pathToRoot', 'D:/Dropbox/Work/Repos/runescape-feeds/');
define('pathToPublic', pathToRoot .'public/');
define('pathToSystem', pathToRoot .'system/');
define('pathToLibraries', pathToSystem .'libraries/');

// Include and initialize SimplePie
require_once pathToLibraries. 'simple-pie-compiled.inc.php';
$simplePie = new SimplePie();

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<title>Bootstrap</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">

		<!-- Styles -->
		<link href="assets/css/styles.css" rel="stylesheet">

		<!-- Google Analytics -->
		<script>
			var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
			(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
			g.src='//www.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g,s)}(document,'script'));
		</script>
	</head>

	<body>
		<div id='wrapper'>
			<ul class="nav nav-tabs">
				<li><a href="#rsnews" data-toggle="tab">Runescape News</a></li>
				<li><a href="#rsblogs" data-toggle="tab">Runescape Blogs</a></li>
				<li><a href="#rssocial" data-toggle="tab">Runescape Social</a></li>
			 	<li><a href="#about" data-toggle="tab">About</a></li>
			</ul>

			<div class="tab-content">
			  <div class="tab-pane active" id="rsnews">xxx</div>
			  <div class="tab-pane" id="rsblogs">yyy</div>
			  <div class="tab-pane" id="rssocial">uuu</div>
			  <div class="tab-pane" id="about">
					<p>This page is designed to provided people with the latest goings on in <a href="http://www.runescape.com" title="Runescape homepage">Runescape</a><p>
					<p>This page was built using <a href="http://simplepie.org/" title="The SimplePie website">SimplePie</a> and the <a href="http://twitter.github.io/bootstrap/" title="Bootstrap!">Twitter Bootstrap</a>.</p>
					<p>You can find the source code for this on <a href='https://bitbucket.org/BeingTomGreen/runescape_feeds'>Bitbucket</a>.</p>
					<p><a href='https://bitbucket.org/BeingTomGreen/runescape_feeds/issues'>Found a bug?</a></p>
					<p>Built by <a href='https://twitter.com/beingtomgreen'>@beingtomgreen</a></p>
				</div>
			</div>
		</div>

		<!-- Javascript -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
		<script src="assets/js/bootstrap.min.js"></script>
	</body>
</html>