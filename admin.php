<html>
<head>
	<!-- Mobile support -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>
	<?php $pg=1;require_once("includes.php"); ?>
	This is our admin page.<br/>
	You should see it only if you are admin.
	<?php 
		//Report errors
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(-1);
		
		require_once("api/api.php");
		if (isset($_SESSION["user"]) && isset($_SESSION["pass"]))
		{
			$api=new api($_SESSION["user"],$_SESSION["pass"]);
		}
		else
		{
			$api=new api("","");
		}
		$api->auth();
		$api->is_auth(1,1);
	?>
	
</body>
</html>