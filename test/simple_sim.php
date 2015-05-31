<html>
<!-- Some CSS to define Rishi's favourite Helvetica Font -->
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
<script src="<?php echo $root_dir;?>js/jquery.js"></script>
<script src="<?php echo $root_dir;?>js/bootstrap.min.js"></script>
	<div class='container-fluid'>
		<div class='row'>
			Insert capacity of bottle 1: <input type='text' id='a_in_vol'/><br/>
			Insert capacity of bottle 2: <input type='text' id='b_in_vol'/><br/>
			<input type='submit' id='vol_set' value='New Game' onclick='new_game()'/>
		</div>
		<div class='row' id='game_disp'>
			<!--<p> Bottle 1: <span id='a_vol'>0</span></p>
			<p> Bottle 2: <span id='b_vol'>0</span></p>
			<button type='button' onclick='fill_a()'>Fill Bottle 1</button>
			<button type='button' onclick='fill_b()'>Fill Bottle 2</button>
			<button type='button' onclick='pour_a()'>Empty Bottle 1</button>
			<button type='button' onclick='pour_b()'>Empty Bottle 2</button>
			<button type='button' onclick='pour_a_to_b()'>Pour Bottle 1 to Bottle 2</button>
			<button type='button' onclick='pour_b_to_a()'>Pour Bottle 2 to Bottle 1</button>-->
		</div>
		<script>
			var vol_a,vol_a_max;
			var vol_b,vol_b_max;
			var game_start=0;
			function new_game()
			{
				vol_a_max=$("#a_in_vol").val();
				vol_b_max=$("#b_in_vol").val();
				vol_a=0;
				vol_b=0;
				game_start=1;
				$("#game_disp").html("<p> Bottle 1: <span id='a_vol'>0</span></p><p> Bottle 2: <span id='b_vol'>0</span></p><button type='button' onclick='fill_a()'>Fill Bottle 1</button><button type='button' onclick='fill_b()'>Fill Bottle 2</button><button type='button' onclick='pour_a()'>Empty Bottle 1</button><button type='button' onclick='pour_b()'>Empty Bottle 2</button><button type='button' onclick='pour_a_to_b()'>Pour Bottle 1 to Bottle 2</button><button type='button' onclick='pour_b_to_a()'>Pour Bottle 2 to Bottle 1</button>");
				update_vals();
			}
			function update_vals()
			{
				if (game_start==1)
				{
					$("#a_vol").text(vol_a);
					$("#b_vol").text(vol_b);
				}
				else
				{
					alert("Please start the game by inserting values and pressing New Game");
				}
			}
			function fill_a()
			{
				vol_a=vol_a_max;
				update_vals();
			}
			function fill_b()
			{
				vol_b=vol_b_max;
				update_vals();
			}
			function pour_a()
			{
				vol_a=0;
				alert("Hi");
				update_vals();
			}
			function pour_b()
			{
				vol_b=0;
				update_vals();
			}
			function pour_a_to_b()
			{
				var vol_b_new=max(vol_b_max,vol_b+vol_a);
				vol_a-=(vol_b_new-vol_b);
				vol_b=vol_b_new;
				update_vals();
			}
			function pour_b_to_a()
			{
				var vol_a_new=max(vol_a_max,vol_b+vol_a);
				vol_b-=(vol_a_new-vol_a);
				vol_a=vol_a_new;
				update_vals();
			}
		</script>
	</div>
</html>