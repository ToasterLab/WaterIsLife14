<?php 
session_start();
$pg=4;
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require_once("api/api.php");
$test=0;
$res="";
if (isset($_SESSION["error"]))
{
	$res=$_SESSION["error"];
	unset($_SESSION["error"]);
}
//echo "Hai";
//echo $_POST["user"];
if (isset($_POST["user"]) && isset($_POST["pass"]))
{
	//echo "Testt";
	$api=new api($_POST["user"],$_POST["pass"]);
	$test=1;
}
if ($test==0 && isset($_SESSION["user"]) && isset($_SESSION["pass"]))
{
	echo "Header Sent";
	$test=2;
	header("Location: home.php");
}
if ($test==1)
{
	//echo "Test";
	$res=$api->auth();
	$ok=$api->is_school();
	if ($ok)
	{
		header("Location: register.php");
	}
	else if ($res=="Success")
	{
		//echo "Test: ".$test;
		header("Location: home.php");
	}
}
//var_dump($_SESSION);
?>
<html>
<head>
	<!-- Mobile support -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<style>
				video#bgvid {
		position: fixed; right: 0; bottom: 0;
		min-width: 100%; min-height: 100%;
		width: auto; height: auto; z-index: -100;
		background: url(img/static_bg.png) no-repeat;
		background-size: cover;
		}
	</style>
</head>
<body>
	<div id='outer_div'>
	<!--<video autoplay loop poster="img/static_bg.png" id="bgvid">
		<source src="vid/water_wave.mp4" type="video/mp4">
	</video>-->
	<?php require_once("includes.php");?>
	
	<div id='yt_div'>
	</div>
	<div style='margin-top:110px;'></div>
	<div class='container-fluid'  id='da_container'>
		<div class='top-buffer'></div>
		<div class='col-md-4 col-md-offset-4' style="background-color:white;box-shadow: 0px 0px 40px #888888;border-radius:25px;">
			<div style='margin-top:30px;'></div>
			<center><img src='img/wc_logo.jpg' height='100' width='100' /></center>
			<div style='margin-top:10px;'></div>
			<center><span style='font-family:HelveticaUltLt;font-size:55px;'>WATER IS LIFE</span><br/>
			<span style='font-family:HelveticaUltLt;font-size:20px;position:relative;bottom:20px;'>RI-Maurick International Water Conference</span></center>
			<form action='login.php' method='post' style='position:relative;bottom:10px;'>
				<label for='user'>Username</label>
				<input type='text' placeholder='USERNAME' name='user' id='user' class='form-control' style='background-color:#cccccc;color:#888888;text-align:center;font-family:HelveticaUltLt;font-size:18px;'/>
				<div style='margin-top:10px;'></div>
				<label for='pass'>Password</label>
				<input type='password' placeholder='PASSWORD' name='pass' id='pass' class='form-control' style='background-color:#cccccc;color:#888888;text-align:center;font-family:HelveticaUltLt;font-size:18px;'/>
				<div style='margin-top:10px;'></div>
				<input type="submit" class="form-control" style='color:#888888;text-align:center;border-style:solid;border-color:#ffffff;font-family:HelveticaLt;font-size:24px;position:relative;top:3px;' value='PROCEED'/>
				<div style='margin-top:10px;'></div>
				<?php
					//echo $test;
					if ($test==1)
					{
						if ($res!="Success")
						{
							echo "<p class='help-block' style='color:#FF0000;text-align:center;'>".$res."</p>";
						}
					}
					/*if ($test==1 || $test==2)
					{
						header("Location: home.php");
					}*/
				?>
				<!--<p class='help-block'>Note: If you are an affiliated school, please login to register.</p>
				<p class='help-block'>If you are not an affiliated school, please contact Mr. Wong Tze Yang at 97629938/tzeyang.wong@ri.edu.sg for inquiries</p>-->
			</form>
			<div style='margin-top:10px;'></div>
		</div>
	</div>
	</div>
<script>
	 /*$().ready(function() {
                $('#outer_div').tubular({videoId: 'IstSW5mHajM'}); // where idOfYourVideo is the YouTube ID.
        });*/
</script>
</body>
</html>