<html>
<head>
	<!-- Mobile support -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>
	<?php $pg=0;require_once("includes.php"); ?>
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
		if ($api->is_school() || $api->was_school())
		{
			unset($_SESSION["user"]);
			unset($_SESSION["pass"]);
			header("Location: login.php");
		}
		else
		{
			$api->is_auth(3,1);
		}
		$api=new api("","");
	?>
	<div class='container-fluid'>
	
		<div class='top-buffer'></div>
		<div class='row'>
			<div class='col-md-3'>
				<ul>
					<li>Thiz iz left col</li>
					<li>Moar stuff on left col</li>
					<li>Awesum left col</li>
					<li>What iz diz?</li>
					<li>Y Engrish so bad?</li>
				</ul>
			</div>
			<div class='col-md-7'>
				Thiz col iz dynamic
				<?php
					echo $api->get_msg();
				?>
			</div>
		</div>
	</div>
	
</body>
</html>