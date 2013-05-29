<?php

// Set Cahce to true/false
$enableCache = false;

// Set defualt Timezone
date_default_timezone_set('Europe/London');

// Include SimplePie
require_once '../system/libraries/simple-pie-compiled.inc.php';
require_once '../system/libraries/functions.inc.php';

// Runescape News
$rsNews = new SimplePie();
$rsNews->set_feed_url(['http://services.runescape.com/m=news/latest_news.rss']);
$rsNews->enable_cache($enableCache);
$rsNews->set_item_limit(5);
$rsNews->init();
$rsNews->handle_content_type();

// Runescape Social
$rsSocial = new SimplePie();
$rsSocial->set_feed_url(['http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=runescape']);
$rsSocial->enable_cache($enableCache);
$rsSocial->set_item_limit(5);
$rsSocial->init();
$rsSocial->handle_content_type();

// When we end our PHP block, we want to make sure our DOCTYPE is on the top line to make sure that the browser snaps into Standards Mode.
?><!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<title>Runescape News!</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
			<ul class='nav nav-tabs' id='tabs'>
				<li><a href='#rsnews' data-toggle='tab'>Runescape News</a></li>
				<li><a href='#rssocial' data-toggle='tab'>Runescape Social</a></li>
				<li><a href='#about' data-toggle='tab'>About</a></li>
			</ul>

			<div class='tab-content'>
				<div class='tab-pane active' id='rsnews'>
				<?php //Runescape News
					// Check to see if we have error(s)
					if ($rsNews->error())
					{
						// Display the error(s)
						echo '<p>'. $rsNews->error() .'</p>';
					}
					// No error(s)
					else
					{
						// Loop through each item
						foreach($rsNews->get_items() as $item) {
							// Print the item out
							echo '<div class="chunk">';
							echo '<a href="'. $item->get_link() .'">'. $item->get_title() .'</a><br />';
							echo '<p>'. $item->get_description() .'</p>';
							echo '<div class="footer">Source: <a href="http://services.runescape.com/m=news/list.ws">Runescape News Archive</a> | '. makeRelativeDate($item->get_date()) .'</div>';
							echo '</div>';
							echo '<hr />';
						}
					}
				?>
				</div>
				<div class='tab-pane' id='rssocial'>
				<?php //Runescape Social
					// Check to see if we have error(s)
					if ($rsSocial->error())
					{
						// Give a friendly error message..
						echo '<p>Unfortunately this feed is currently unavailable, this could be due to maintainance or an error with the feed. Please try again later.</p>';
						// Log the error(s)
						error_log($rsSocial->error());
					}
					// No error(s)
					else
					{
						// Loop through each item
						foreach($rsSocial->get_items() as $item) {
							// Print the item out
							echo '<div class="chunk">';
							echo '<p>'. tweetify($item->get_description()) .'</p>';
							echo '<div class="footer">Source: <a href="'. $item->get_link() .'">Official Runescape Twitter</a> | '. makeRelativeDate($item->get_date()) .'</div>';
							echo '</div>';
							echo '<hr />';
						}
					}
				?>
				</div>
				<div class='tab-pane' id='about'>
					<p>This page is designed to provided people with the latest goings on in <a href='http://www.runescape.com' title='Runescape homepage'>Runescape</a><p>
					<p>This page was built using <a href='http://simplepie.org/' title='The SimplePie website'>SimplePie</a> and <a href='http://twitter.github.io/bootstrap/' title='Bootstrap!'>Twitter Bootstrap</a>.</p>
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
unset($rsNews, $rsSocial);
?>