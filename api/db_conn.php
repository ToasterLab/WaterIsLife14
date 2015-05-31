<?php
	//echo "Yo!!!";
	require("db_param.php");
	//echo "Hai Madam, I'm Adam...";
	$mysqli = new mysqli($host,$user,$pass,$db);
	if ($mysqli -> connect_errno)
	{
		echo "Could not connect (".$mysqli -> connect_errno.") :-( ".$mysqli -> connect_error;
	}
?>