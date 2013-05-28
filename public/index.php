<?php

// Define various paths
define('pathToRoot', 'D:/Dropbox/Work/Repos/runescape-feeds/');
define('pathToPublic', pathToRoot .'public/');
define('pathToSystem', pathToRoot .'system/');
define('pathToLibraries', pathToSystem .'libraries/');

// Set defualt Timezone
date_default_timezone_set('Europe/London');

// Include SimplePie
require_once pathToLibraries. 'simple-pie-compiled.inc.php';

// Initialize SimplePie
$rsNews = new SimplePie();
$rsSocial = new SimplePie();

// Set the feed URLS
$rsNews->set_feed_url('http://services.runescape.com/m=news/latest_news.rss');
$rsSocial->set_feed_url('http://services.runescape.com/m=news/latest_news.rss');

// Set caching
$rsNews->enable_cache(false);
$rsSocial->enable_cache(false);

// Init
$rsNews->init();
$rsSocial->init();

// Auto handle the content types
$rsNews->handle_content_type();
$rsSocial->handle_content_type();

// When we end our PHP block, we want to make sure our DOCTYPE is on the top line to make sure that the browser snaps into Standards Mode.
?><!DOCTYPE html>
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
			<ul class='nav nav-tabs'  id='tabs'>
				<li><a href='#rsnews' data-toggle='tab'>Runescape News</a></li>
				<li><a href='#rssocial' data-toggle='tab'>Runescape Social</a></li>
			 	<li><a href='#about' data-toggle='tab'>About</a></li>
			</ul>

			<div class='tab-content'>
			  <div class='tab-pane active' id='rsnews'>
				<?php //Runescape News
					foreach($rsNews->get_items() as $item) {
						echo $item->get_title();
					}
				?>
				</div>
			  <div class='tab-pane' id='rssocial'>
				<?php //Runescape Social
					foreach($rsSocial->get_items() as $item) {
						echo $item->get_title();
					}
				?>
			  </div>
			  <div class='tab-pane' id='about'>
					<p>This page is designed to provided people with the latest goings on in <a href='http://www.runescape.com' title='Runescape homepage'>Runescape</a><p>
					<p>This page was built using <a href='http://simplepie.org/' title='The SimplePie website'>SimplePie</a> and the <a href='http://twitter.github.io/bootstrap/' title='Bootstrap!'>Twitter Bootstrap</a>.</p>
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
		<script>
  		$(function () {
    		$('#tabs a:first').tab('show');
  		})
		</script>
	</body>
</html>
<?php
// Clean up!
unset($rsNews);
unset($rsSocial);
?>