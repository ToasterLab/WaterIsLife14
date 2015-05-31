<!-- All the includes for this project-->

<!-- Code to check for Login -->
<?php
	if ($pg!=4)
	{
		session_start();
	}
	$login=false;
	//Report errors
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	
	//Create API Instance
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
?>

<!-- Some CSS to define Rishi's favourite Helvetica Font ;) -->
<?php require_once("web_data.php")?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo $root_dir;?>css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="<?php echo $root_dir;?>css/bootstrap-theme.min.css">

<style>
@font-face{
	font-family: "Helvetica";
	src: url("<?php echo $root_dir;?>fonts/HelveticaNeueLTStd-HvCn.otf") format("opentype");
}
@font-face{
	font-family: "HelveticaLt";
	src: url("<?php echo $root_dir;?>fonts/HelveticaNeueLTPro-Lt.otf") format("opentype");
}
@font-face{
	font-family: "HelveticaUltLt";
	src: url("<?php echo $root_dir;?>fonts/HelveticaNeueLTPro-UltLt.otf") format("opentype");
}
.top-buffer{
	margin-top:20px;
}

</style>

<!-- Latest compiled and minified JavaScript -->
<script src="<?=$root_dir?>js/jquery.js"></script>
<script src="<?=$root_dir?>js/bootstrap.min.js"></script>
<script src="<?=$root_dir?>js/jquery.sidr.min.js"></script>

<!-- Tubular API-->
<script type="text/javascript" charset="utf-8" src="teaser/js/jquery.tubular.1.0.js"></script> 

<!-- Navbar -->
<link rel="shortcut icon" href="favicon.ico" />
<nav class="navbar navbar-default" role="navigation" id="mainNavBar">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="index.php"><img src='img/wc_logo.jpg' height='24' width='24' /></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav">
			<li <?php if ($pg==0){echo " class='active'";}?>><a href="index.php">Home</a></li>
			<?php 
				if ($api->is_auth(1,0))
				{
					echo "<li";
					if ($pg==1){echo " class='active'";}
					echo "><a href='admin.php'>Admin</a></li>";
				}
				if ($api->is_auth(3,0))
				{
					echo "<li";
					if ($pg==2){echo " class='active'";}
					echo "><a href='home.php'>Profile</a></li>";
				}
			?>
			<?php
				if ($api->is_auth(3,0))
				{
					echo "<li";
					if ($pg==3){echo " class='active'";}
					echo "><a href='gallery.php'>Gallery</a></li>";
				}
			?>
			<!--<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
			  <ul class="dropdown-menu">
				<li><a href="#">Action</a></li>
				<li><a href="#">Another action</a></li>
				<li><a href="#">Something else here</a></li>
				<li class="divider"></li>
				<li><a href="#">Separated link</a></li>
				<li class="divider"></li>
				<li><a href="#">One more separated link</a></li>
			  </ul>
			</li>-->
		  </ul>
		  <!--<form class="navbar-form navbar-left" role="search">
			<div class="form-group">
			  <input type="text" class="form-control" placeholder="Search">
			</div>
			<button type="submit" class="btn btn-default">Submit</button>
			By the way login should work =>
		  </form> -->
		  <ul class="nav navbar-nav navbar-right">
		  <?php
			if ($api->is_auth(4,0))
			{
				echo "<li><a href='logout.php'>Logout</a></li>";
			}
			else
			{
				echo "<li><a href='login.php'>Login</a></li>";
			}
		  ?>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>