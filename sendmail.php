<?php

// ------------------------------------

$EMAIL_ADDRESS = "info@medtechsweden.com";
$SITE = "http://medtechsweden.com/";

// ------------------------------------

$displayed_title = "";
$displayed_message = "";
$return_url = $SITE;
$return_delay = 5; //Number of seconds to linger on this page before redirecting back to the static site


if (!empty($_POST))
{

	function get_post_field($key, $defaultValue = "")
	{
		$value = (isset($_POST[$key]) && !empty($_POST[$key])) ? $_POST[$key] : $defaultValue;
		return utf8_decode($value);
	}

	function filter_name($input)
	{
		$rules = array( "\r" => '', "\n" => '', "\t" => '', '"'  => "'", '<'  => '[', '>'  => ']' );
		return trim(strtr($input, $rules));
	}

	function filter_email($input)
	{
		$rules = array( "\r" => '', "\n" => '', "\t" => '', '"'  => '', ','  => '', '<'  => '', '>'  => '' );
		return strtr($input, $rules);
	}
	
	
	$EMAIL_ADDRESS = filter_email($EMAIL_ADDRESS);
	
	$COMMENTER_NAME = filter_name(get_post_field('name', "Anonymous"));
	$COMMENTER_EMAIL_ADDRESS = filter_email(get_post_field('email', $EMAIL_ADDRESS));
	$COMMENTER_ADDRESS = get_post_field('address');
	$COMMENTER_CITY = get_post_field('city');
	$COMMENTER_STATE = get_post_field('state');
	$COMMENTER_ZIP = get_post_field('zip');
	$COMMENTER_PHONE = get_post_field('phone');
	$COMMENTER_FAX = get_post_field('fax');
	
	$COMMENTS = get_post_field('comments');
	
	$COMMENTER_INFO = "$COMMENTER_NAME <$COMMENTER_EMAIL_ADDRESS>\n";
	$COMMENTER_INFO .= "\n";
	$COMMENTER_INFO .= "$COMMENTER_ADDRESS\n";
	$COMMENTER_INFO .= "$COMMENTER_CITY, $COMMENTER_STATE $COMMENTER_ZIP\n";
	$COMMENTER_INFO .= "\n";
	if (!empty($COMMENTER_PHONE)) 	{ $COMMENTER_INFO .= "Phone: $COMMENTER_PHONE\n"; }
	if (!empty($COMMENTER_FAX)) 	{ $COMMENTER_INFO .= "Fax: $COMMENTER_FAX\n"; }
	
	$headers = "From: $COMMENTER_NAME <$EMAIL_ADDRESS>\r\n";
	$headers .= (!empty($COMMENTER_EMAIL_ADDRESS)) ? "Reply-To: $COMMENTER_NAME <$COMMENTER_EMAIL_ADDRESS>\r\n" : "";

	$subject = "Comment from '$COMMENTER_NAME' to Med Tech Sweden Inc.";

	$message = $COMMENTS."\n";
	$message .= "\n";
	$message .= $COMMENTER_INFO;
	

	if (mail($EMAIL_ADDRESS, $subject, $message, $headers))
	{
		$displayed_title = "Comment Received";
		$displayed_message = "Thank you for your comment. We will get back to you as soon as possible.";
		$return_delay = 5;
	}
	else
	{
		$displayed_title = "Problem sending comment";
		$displayed_message = "There was a problem sending your comment. Please contact us via email instead at <a href=\"mailto:$EMAIL_ADDRESS\">$EMAIL_ADDRESS</a>.";
		$return_delay = 20;
	}

}
else
{
	header("Location: $return_url");
	$displayed_title = "";
	$displayed_message = "";
	$return_delay = 0;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd"> 
<html> 
	<head> 
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<?php if (isset($_POST['return_url']))
		{
			echo "<meta http-equiv=\"refresh\" content=\"$return_delay;url='$return_url'\" />";
		} ?>
		<title><?php echo $displayed_title; ?></title> 
	</head>
<body>
<h1><?php echo $displayed_title; ?></h1>
	<p><?php echo $displayed_message; ?></p>
	<?php if (isset($return_url))
	{
		echo '<p>You are now returning to the page you were on. Click the link if you are not redirected automatically.</p>';
		echo '<p><a href="'.$return_url.'">'.$return_url.'</a></p>';
	} ?>
</body>
</html>

