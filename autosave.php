<?php
	session_start();
	require_once('api/api.php');
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	//echo var_dump($_POST);
	$jarr=$_POST["abc"];
	$jarr=json_decode($jarr);
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
		$sql="select * from wc_autosave where user_id='".$_SESSION["user"]."';";
		$res=$api->do_sqli($sql);
		$cnt=mysqli_num_rows($res);
		echo "$cnt rows";
		if ($cnt==0)
		{
			foreach ($jarr as $key => $val)
			{
				$sql="insert into wc_autosave(user_id,field_id,field_val) values('".$_SESSION["user"]."','$key','$val');";
				$api->do_sqli($sql);
			}
		}
		else
		{
			foreach ($jarr as $key => $val)
			{
				$sql="update wc_autosave set field_val='$val' where user_id='".$_SESSION["user"]."' AND field_id='$key';";
				$api->do_sqli($sql);
			}
		}
	}
	else
	{
		echo "You need to login again for security purposes";
	}
?>