<html>
<head>
	<!-- Mobile support -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>
	<?php $pg=2;require_once("includes.php"); ?>
	This is your home page.<br/>
	You should see it if you are logged in.
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
		if ($api->is_school())
		{
			header("Location: register.php");
		}
		else
		{
			$api->is_auth(3,1);
		}
	?>
	
</body>
</html>