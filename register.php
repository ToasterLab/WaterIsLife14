<!--Require Authentication of Redirect-->
<?php
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require_once("api/api.php");
//echo "Hai";
//echo $_POST["user"];
	//echo "Test";
if (isset($_SESSION["user"]) && isset($_SESSION["pass"]))
{
	$api=new api($_SESSION["user"],$_SESSION["pass"]);
}
else
{
	$api=new api("","");
}
$api->auth();
$ok=$api->is_school();
if (!$ok)
{
	//echo "Test: ".$test;
	header("Location: index.php");
}
?>

<html>
<head><link rel="shortcut icon" href="favicon.ico" /></head>
<!-- All the includes for this project-->

<!-- Code to check for Login -->

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
video#bgvid {
	position: fixed; right: 0; bottom: 0;
	min-width: 100%; min-height: 100%;
	width: auto; height: auto; z-index: -100;
	background: url(img/static_bg.png) no-repeat;
	background-size: cover;
}
</style>
<body>
<video autoplay loop poster="img/static_bg.png" id="bgvid">
	<!--<source src="vid/water_wave.mp4" type="video/mp4">-->
</video>
<!-- Latest compiled and minified JavaScript -->
<script src="<?php echo $root_dir;?>js/jquery.js"></script>
<script src="<?php echo $root_dir;?>js/bootstrap.min.js"></script>
<div class='container-fluid'>
<div style='margin-top:50px;'></div>
<div class='row'>
<div class='col-md-8 col-md-offset-2' style="padding-bottom:30px;padding-top:30px;padding-left:50px;padding-right:50px;background-color:white;box-shadow: 0px 0px 40px #888888;border-radius:25px;overflow-y: scroll;overflow-x: hidden;height: 500px;margin: auto;position: absolute;left: 50%;top: 50%; margin-left: -435px;margin-top: -250px;">
	<div style='margin-top:10px;'></div>
	<span style='font-family:HelveticaLt;font-size:30px;'>Register. </span><span style='font-family:HelveticaUltLt;font-size:30px;'>5 Simple Steps.</span>
	<div style='margin-top:10px;'></div>
	<ul class="nav nav-tabs">
	  <li id='form1li' class="active" style='font-family:HelveticaLt;font-size:16px;'><a href="#" onclick="hai('form1')" style='color:#000000;'>School Info</a></li>
	  <li id='form2li' style='font-family:HelveticaLt;font-size:16px;'><a href="#" onclick="hai('form2')" style='color:#000000;'>Teacher Info</a></li>
	  <li id='form3li' style='font-family:HelveticaLt;font-size:16px;'><a href="#" onclick="hai('form3')" style='color:#000000;'>Project Info</a></li>
	  <li id='form4li' style='font-family:HelveticaLt;font-size:16px;'><a href="#" onclick="hai('form4')" style='color:#000000;'>Student Info</a></li>
	  <li id='form5li' style='font-family:HelveticaLt;font-size:16px;'><a href="#" onclick="hai('form5')" style='color:#000000;'>Visa Info</a></li>
	</ul>
	<br/>
	<div>
		<form id='daform' role='form' method='post' action='real_register.php'>
		<div id="form1"><?php require_once("forms/school_form.php");?></div>
		<div id="form2"><?php require_once("forms/teacher_form.php");?></div>
		<div id="form3"><?php require_once("forms/project_form.php");?></div>
		<div id="form4"><?php require_once("forms/student_form.php");?></div>
		<div id="form5"><?php require_once("forms/visa_form.php");?></div>
		</form>
	</div>
</div>
</div>
<div style='margin-top:50px;'></div>
</div>
</body>
<script>
alert("Please do not take more than 1 hour to fill up this form. Please refresh this page and login again if it's been more than 1 hour since you started this page. Registration is only completed after you press the 'Submit' button and come to a page saying an email will be sent. This form comes with autosave. Thank You.");
var num_proj=1;
var t_span=$("#teacher_span").html();
var p_span=$("#proj_span").html();
var s_span=$("#student_span").html();
var req_done=1;
get_from_db();
setInterval(function(){store_in_db();},10000);
$("#daform").submit(function(){
	if (check_all_for_unfilled()==0)
	{
		return false;
	}
	abc=$("#project1_abstract").val();
	abc = abc.replace(/(^\s*)|(\s*$)/gi,"");
	abc=abc.replace(/\n/," ");
	abc = abc.replace(/[ ]{2,}/gi," ");
	var l1=abc.split(" ").length;
	abc=$("#project2_abstract").val();
	abc = abc.replace(/(^\s*)|(\s*$)/gi,"");
	abc=abc.replace(/\n/," ");
	abc = abc.replace(/[ ]{2,}/gi," ");
	var l2=abc.split(" ").length;
	if (l1>200 || l2>200)
	{
		alert("Exceeded Maximum Project Word Count\n");
		return false;
	}
	if (document.getElementById('tandc').checked==false)
	{
		alert("You must accept the terms and conditions to register");
		return false;
	}
	return true;
});

$("#proj_span").html(p_span+p_span.replace(/project1/g,"project2").replace(/Project 1/g,"Project 2"));
$("#teacher_span").html(t_span+t_span.replace(/teacher1/g,"teacher2").replace(/Teacher 1/g,"Teacher 2"));
//Initiate all student spans
$("#student_span").html(s_span+s_span.replace(/student1/g,"student2").replace(/Student 1/g,"Student 2")+s_span.replace(/student1/g,"student3").replace(/Student 1/g,"Student 3")+s_span.replace(/student1/g,"student4").replace(/Student 1/g,"Student 4")+s_span.replace(/student1/g,"student5").replace(/Student 1/g,"Student 1").replace(/Project 1/g,"Project 2")+s_span.replace(/student1/g,"student6").replace(/Student 1/g,"Student 2").replace(/Project 1/g,"Project 2")+s_span.replace(/student1/g,"student7").replace(/Student 1/g,"Student 3").replace(/Project 1/g,"Project 2")+s_span.replace(/student1/g,"student8").replace(/Student 1/g,"Student 4").replace(/Project 1/g,"Project 2"));

//Some initiation events
$("#project1_abstract").bind("input",function(event){
	abc=$("#project1_abstract").val();
	abc = abc.replace(/(^\s*)|(\s*$)/gi,"");
	abc=abc.replace(/\n/," ");
	abc = abc.replace(/[ ]{2,}/gi," ");
	$("#project1_word_count").html(abc.split(" ").length);
});
$("#project2_abstract").bind("input",function(event){
	abc=$("#project2_abstract").val();
	abc = abc.replace(/(^\s*)|(\s*$)/gi,"");
	abc=abc.replace(/\n/," ");
	abc = abc.replace(/[ ]{2,}/gi," ");
	$("#project2_word_count").html(abc.split(" ").length);
});

//Further Defocusing
hai("form1");

function store_in_db()
{
	if (req_done==1)
	{
		req_done=0;
	}
	else
	{
		//Miss the storing because storing failed
		return;
	}
	var a = {};
	var cnt = 0;
	$("input, textarea, select","#daform").each(function(){
		a[$(this).attr('id')]=$(this).val();
	});
	var jsstr=JSON.stringify(a);
	$.ajax({
			url : "autosave.php",
			type : "post",
			data : {"abc" : jsstr},
			success : function(result)
			{
				//alert("Storage Successful");
				req_done=1;
			}
	});
}

function get_from_db()
{
	$.ajax({
			url : "g_autosave.php",
			type : "post",
			success : function(result)
			{
				//alert(result);
				var a = JSON.parse(result);
				for (var key in a)
				{
					$("#"+key).val(a[key]);
				}
			}
	});
}

function defocus(id)
{
	$("div, label, input, button, select, p, span, option","#"+id).each(function(){
		$(this).css('display','none');
	});
}
function focus(id)
{
	$("div, label, input, button, select, p, span, option","#"+id).each(function(){
		$(this).css('display','block');
	});
	if (id=='form2')
	{
		if (check_some_for_unfilled(2)==1)
		{
			update_teacher_form();
		}
	}
	else if (id=='form3')
	{
		if (check_some_for_unfilled(3)==1)
		{
			update_project_form();
		}
	}
	else if (id=='form4')
	{
		if (check_some_for_unfilled(4)==1)
		{
			update_student_form();
		}
	}
	else if (id=='form5')
	{
		if (check_all_for_unfilled()==1)
		{
			update_visa_info();
			update_summary();
		}
	}
}

function check_for_unfilled(id)
{
	var success=1;
	hai(id);
	$("input, select","#"+id).each(function(){
		if ($(this).val()=="" && $(this).css('display')!="none")
		{
			if (success==1)
			{
				alert("Some previous fields have not yet been filled up, a NIL response is required");
				$(this).focus();
			}
			success=0;
		}
	});
	return success;
}

function check_some_for_unfilled(id)
{
	for (var i=1; i<id; i++)
	{
		if (check_for_unfilled("form"+i)==0){return 0;}
	}
	defocus("form1");
	defocus("form2");
	defocus("form3");
	defocus("form4");
	defocus("form5");
	$("#form1li").attr('class','');
	$("#form2li").attr('class','');
	$("#form3li").attr('class','');
	$("#form4li").attr('class','');
	$("#form5li").attr('class','');
	$("#form"+id+"li").attr('class','active');
	$("div, label, input, button, select, p, span, option","#form"+id).each(function(){
		$(this).css('display','block');
	});
	return 1;
}

function check_all_for_unfilled()
{
	if (check_for_unfilled("form1")==0){return 0;}
	if (check_for_unfilled("form2")==0){return 0;}
	if (check_for_unfilled("form3")==0){return 0;}
	if (check_for_unfilled("form4")==0){return 0;}
	defocus("form1");
	defocus("form2");
	defocus("form3");
	defocus("form4");
	defocus("form5");
	$("#form1li").attr('class','');
	$("#form2li").attr('class','');
	$("#form3li").attr('class','');
	$("#form4li").attr('class','');
	$("#form5li").attr('class','active');
	$("div, label, input, button, select, p, span, option","#form5").each(function(){
		$(this).css('display','block');
	});
	//hai("form5");
	return 1;
}

function hai(id)
{
	defocus("form1");
	defocus("form2");
	defocus("form3");
	defocus("form4");
	defocus("form5");
	$("#form1li").attr('class','');
	$("#form2li").attr('class','');
	$("#form3li").attr('class','');
	$("#form4li").attr('class','');
	$("#form5li").attr('class','');
	$("#"+id+"li").attr('class','active');
	focus(id);
	update_num_teacher();
}

function update_num_proj()
{
	num_proj=$("#school_num_proj").val();
	$("#num_proj").html(num_proj);
	if (num_proj==1)
	{
		$("#teacher_num").val(1);
		$("#num_proj_alert").text("Note: You are allowed a maximum of 4 students and 1 teacher");
	}
	else if (num_proj==2)
	{
		$("#num_proj_alert").text("Note: You are allowed a maximum of 8 students and 2 teachers");
	}
	else
	{
		$("#num_proj_alert").text("Note: Die Hacker!!!");
	}
	update_project_form();
	//Can only be changed in form 1
	hai("form1");
}

function update_num_teacher()
{
	num_proj=$("#school_num_proj").val();
	if (num_proj==1)
	{
		//$("#teacher_num").html("<option value='1'>1</option>");
		$("#teacher_num").val(1);
		$("#teacher_op2").css('display','none');
		$("#teacher_num_alert").html("Note: Because your school is only sending 1 project, you are allowed at most 1 teacher");
	}
	else
	{
		//$("#teacher_num").html("<option value='1'>1</option><option value'2'>2</option>");
		$("#teacher_op2").css('display','block');
		$("#teacher_num_alert").html("Note: You are allowed at most 2 teachers");
	}
}

function update_teacher_form()
{
	//alert("Haii");
	update_contents();
	if ($("#teacher_num").val()==1)
	{
		//alert("Kay");
		focus("teacher1_formgrp");
		defocus("teacher2_formgrp");
	}
	else if ($("#teacher_num").val()==2)
	{
		//alert("KK");
		focus("teacher1_formgrp");
		focus("teacher2_formgrp");
	}
	else
	{
		//alert("KKK");
		$("#teacher_span").html("Die Hacker");
	}
}

function update_project_form()
{
	num_proj=$("#school_num_proj").val();
	//alert("Haii");
	update_contents();
	if (num_proj==1)
	{
		//alert("Kay");
		focus("project1_formgrp");
		defocus("project2_formgrp");
	}
	else if (num_proj==2)
	{
		//alert("KK");
		focus("project1_formgrp");
		focus("project2_formgrp");
	}
	else
	{
		//alert("KKK");
		$("#proj_span").html("Die Hacker");
	}
}

function update_student_form()
{
	num_proj=$("#school_num_proj").val();
	var num_stu1=$("#student_proj1_num").val();
	var num_stu2=$("#student_proj2_num").val();
	//alert("num_stu1: "+num_stu1+",num_stu2: "+num_stu2);
	if (num_proj==1)
	{
		num_stu2=0;
		defocus("student_proj2_form");
	}
	for (var i=1; i<=4; i++)
	{
		if (i<=num_stu1)
		{
			focus("student"+i+"_formgrp");
		}
		else
		{
			defocus("student"+i+"_formgrp");
		}
	}
	
	for (var i=5; i<=8; i++)
	{
		if (i-4<=num_stu2)
		{
			focus("student"+i+"_formgrp");
		}
		else
		{
			defocus("student"+i+"_formgrp");
		}
	}
}

function update_visa_info()
{
	var req_visa=["Armenia","Azerbaijan","Belarus","Georgia","India","Kazakhstan","Kyrgyzstan","Moldova","Myanmar","Nigeria","Russia","China","Tajikistan","Turkmenistan","Ukraine","Uzbekistan","Afghanistan","Algeria","Bangladesh","Egypt","Iran","Iraq","Jordan","Lebanon","Libya","Morocco","Pakistan","Saudi Arabia","Somalia","Sudan","Syria","Tunisia","Yemen"];
	var a="Teachers<table class='table'><tr><td>#</td><td>Name</td><td>Type</td><td>Requires Visa</td></tr>";
	var num_teacher=$("#teacher_num").val();
	var num_stu1=$("#student_proj1_num").val();
	var num_stu2=$("#student_proj2_num").val();
	var visa_req=0;
	var cnt=0;
	if (num_proj==1)
	{
		num_stu2=0;
	}
	for (var i=1; i<=num_teacher; i++)
	{
		var tmp=$("#teacher"+i+"_nationality").val();
		cnt+=1;
		if (req_visa.indexOf(tmp)==-1)
		{
			//No visa required
			a+="<tr><td>"+cnt+"</td><td>"+$("#teacher"+i+"_name").val()+"</td><td>Teacher</td><td><span style='color:#00FF00'>NO</span></td></tr>";
		}
		else
		{
			//Requires Visa
			visa_req=1;
			a+="<tr><td>"+cnt+"</td><td>"+$("#teacher"+i+"_name").val()+"</td><td>Teacher</td><td><span style='color:#FF0000'>YES</span></td></tr>";
		}
	}
	for (var i=1; i<=num_stu1; i++)
	{
		var tmp=$("#student"+i+"_nationality").val();
		cnt+=1;
		if (req_visa.indexOf(tmp)==-1)
		{
			//No visa required
			a+="<tr><td>"+cnt+"</td><td>"+$("#student"+i+"_name").val()+"</td><td>Student</td><td><span style='color:#00FF00'>NO</span></td></tr>";
		}
		else
		{
			//Requires Visa
			visa_req=1;
			a+="<tr><td>"+cnt+"</td><td>"+$("#student"+i+"_name").val()+"</td><td>Student</td><td><span style='color:#FF0000'>YES</span></td></tr>";
		}
	}
	for (var i=5; i<=parseInt(num_stu2)+4; i++)
	{
		var tmp=$("#student"+i+"_nationality").val();
		cnt+=1;
		if (req_visa.indexOf(tmp)==-1)
		{
			//No visa required
			a+="<tr><td>"+cnt+"</td><td>"+$("#student"+i+"_name").val()+"</td><td>Student</td><td><span style='color:#00FF00'>NO</span></td></tr>";
		}
		else
		{
			//Requires Visa
			visa_req=1;
			a+="<tr><td>"+cnt+"</td><td>"+$("#student"+i+"_name").val()+"</td><td>Student</td><td><span style='color:#FF0000'>YES</span></td></tr>";
		}
	}
	a+="</table>";
	$("#visa_info_div").html(a);
	if (visa_req==1)
	{
		$("#pdf_div").html("The Visa Documentation will be attached in the email.");
		//ajax_pdf();
	}
	else
	{
		$("#pdf_div").html("Yay, you don't need a Visa :D");
	}
}

function ajax_pdf()
{
	alert("Sending AJAX");
	$.ajax({url:"pdf_gen.php",
		type:'GET',
		data:{ school_address: "John", teacher1_name: "Boston" },
	success:function(result){
		alert(result);
		$("#pdf_div").html(result);
	}});
}

function update_summary()
{
	var a="You are sending:<p>";
	var num_teacher=$("#teacher_num").val();
	var num_stu1=$("#student_proj1_num").val();
	var num_stu2=$("#student_proj2_num").val();
	a+=num_teacher+" Accompanying Teachers:</p>";
	if (num_proj==1)
	{
		num_stu2=0;
	}
	for (var i=1; i<=num_teacher; i++)
	{
		var tmp=$("#teacher"+i+"_name").val();
		a+="<p>"+tmp+"</p>";
	}
	var tmp2=parseInt(num_stu1)+parseInt(num_stu2);
	a+="<p>"+tmp2+" Students:</p>";
	for (var i=1; i<=num_stu1; i++)
	{
		var tmp=$("#student"+i+"_name").val();
		a+="<p>"+tmp+"</p>";
	}
	for (var i=5; i<=parseInt(num_stu2)+4; i++)
	{
		var tmp=$("#student"+i+"_name").val();
		a+="<p>"+tmp+"</p>";
	}
	//alert(a);
	$("#summ_info").html(a);
}

function termsandc()
{
	alert("<?php require_once("docs/terms_and_conditions.html");?>");
}

function update_contents()
{
	
}
</script>

</html>