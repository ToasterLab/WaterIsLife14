<?php
	session_start();
	require_once('api/api.php');
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	//echo var_dump($_POST);
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
		$arr=array();
		if ($cnt!=0)
		{
			while ($r=mysqli_fetch_array($res))
			{
				$arr[$r[2]]=$r[3];
			}
		}
		echo json_encode($arr);
	}
	else
	{
		echo "You need to login again for security purposes";
	}
?>