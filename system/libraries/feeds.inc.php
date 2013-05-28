<?php

class Feeds {
	/*
	* -------------------------------------------------------------
	* Name:		 tweetify
	* Version:	1.1
	* Date:		 17/07/2010
	* Author:	 Tom Green <KingOfCuddles@gmail.com>
	* Purpose:	Takes a Twitter status and converts Links, @Names and #Searchs into proper links, and replaces RT with the retweet Icon
	* Input:		$tweet = The twitter status
	* 			$class = The CSS class to be applied to the Link
	*				$rel = Allows you to specify the REL attribute of the URL - Defaults to "nofollow"
	*				find more here: http://www.google.com/support/webmasters/bin/answer.py?hl=en&answer=96569
	* -------------------------------------------------------------
	$RT_url = "http://hughbriss.com/wp-content/uploads/2009/11/retweet-icon.png"
	*/

	function tweetify ($tweet, $class = "", $rel = "nofollow", $RT_url = "http://www.zomfshark.co.uk/webmedia/images/retweet_smaller.ico") {
		//Replace links
		$tweet = preg_replace("/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/", "<a href=\"\\0\" rel=\"$rel\" class=\"$class\">\\0</a>", $tweet);
		//Replace @names
		$tweet = preg_replace("#(^|[\n ])@([^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://www.twitter.com/\\2\" rel=\"$rel\" class=\"$class\">@\\2</a>'", $tweet);
		//Replace #Searchs
		$tweet = preg_replace("!(^|[\n ])#([^ \"\t\n\r<]*)!ise", "'\\1<a href=\"http://twitter.com/search?q=\\2\" rel=\"$rel\" class=\"$class\">#\\2</a>'", $tweet);
		$tweet = str_replace("RT", "<img src='$RT_url' alt='ReTweet' class='show'/>", "$tweet");
		return $tweet;
	}

	/*
	* -------------------------------------------------------------
	* Name:		 MakeRelativeDate
	* Version:	1.1
	* Date:		 17/07/2010
	* Author:	 Tom Green <KingOfCuddles@gmail.com>
	* Purpose:	Convert a UNIX timestamp into a relative date
	* Input:		$timestamp = UNIX timestamp or a date which can be converted by strtotime()
	* 			$format = Specify a custom Date/Time format for dates over a certian timeframe
	*				$days = Use only days and ignore times, so if an item was posted 6 hour ago
	* 				it will print Eariler today instead of 6 hours ago
	* -------------------------------------------------------------
	*/
	function MakeRelativeDate($timestamp, $days = false, $format = "l \\t\h\e jS \of F Y")
	{
		//First check if $timestamp is a timestamp...
		//If not, lets try and convert it...
		if (!is_numeric($timestamp))
		{
			$timestamp = strtotime($timestamp);
		}

		//If it still isn't numeric, degrade nicly
		if (!is_numeric($timestamp))
		{
			return "Error converting TimeStamp.";
		}

		//Calculate the difference between now and $timestamp in seconds
		$difference = time() - $timestamp;

		if ($days && $difference < (60*60*24))
		{
			return "Earier today.";
		}
		else
		{
			switch ($difference)
			{
				//Less than 5 Seconds Ago..
				case $difference < 5:
					return "A few seconds ago.";
					break;
				//Less than a Minute ago...
				case $difference < 60:
					return "About " . $difference . " seconds ago.";
					break;
				//Less than 2 Minutes ago...
				case $difference < (60*2):
					return "About a minute ago.";
					break;
				//Less than one Hour ago...
				case $difference < (60*60):
					return "About " . floor($difference / 60) . " minutes ago.";
					break;
				//Less than two Hours Ago...
				case $difference < (60*60*2):
					return "About an hour ago";
					break;
				//Less than 24 Hours ago...
				case $difference < (60*60*24):
					return "About " . floor($difference / (60*60)) . " hours ago.";
					break;
				//Less than two days ago...
				case $difference < (60*60*24*2):
					return "Yesterday.";
					break;
				//Less than a week ago...
				case $difference < (60*60*24*7):
					return floor($difference / (60*60*24)) . " days ago.";
					break;
				//Less than two weeks ago...
				case $difference < (60*60*24*7*2):
					return "Last week.";
					break;
				//Less than a month ago
				case $difference < (60*60*24*7*4.33333):
					return floor($difference / (60*60*24*7)) . " weeks ago.";
					break;
				default:
					return date($format, $timestamp) . ".";
					break;
			}
		}
	}
}



?>