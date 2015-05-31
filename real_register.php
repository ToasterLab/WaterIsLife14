<?php
	/*ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);*/
	error_reporting(E_ALL & E_STRICT);
	ini_set('display_errors', '1');
	ini_set('log_errors', '0');
	ini_set('error_log', './');
	//Request email service
	function gen_pwd()
	{
		$pwd_str="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789,.;[]-=_+{}:\?|\\!@#$%^&*()";
		$a="";
		for ($i=0; $i<6; $i++)
		{
			$a.=$pwd_str[rand(0,strlen($pwd_str)-1)];
		}
		return $a;
	}
	//echo var_dump($_POST);
	//echo "<br/>";
	//Process school information
	$id=0;
	$visa_req=array(
		'0' => "Armenia",
		'1' => "Azerbaijan",
		'2' => "Belarus",
		'3' => "Georgia",
		'4' => "India",
		'5' => "Kazakhstan",
		'6' => "Kyrgyzstan",
		'7' => "Moldova",
		'8' => "Myanmar",
		'9' => "Nigeria",
		'10' => "Russia",
		'11' => "China",
		'12' => "Tajikistan",
		'13' => "Turkmenistan",
		'14' => "Ukraine",
		'15' => "Uzbekistan",
		'16' => "Afghanistan",
		'17' => "Algeria",
		'18' => "Bangladesh",
		'19' => "Egypt",
		'20' => "Iran",
		'21' => "Iraq",
		'22' => "Jordan",
		'23' => "Lebanon",
		'24' => "Libya",
		'25' => "Morocco",
		'26' => "Pakistan",
		'27' => "Saudi Arabia",
		'28' => "Somalia",
		'29' => "Sudan",
		'30' => "Syria",
		'31' => "Tunisia",
		'32' => "Yemen"
	);
	session_start();
	require_once("PHPMailer/PHPMailerAutoload.php");
	
	require_once("api/api.php");
	//echo "Hai";
	//echo "Hai";
	//echo $_POST["user"];
		//echo "Test";
	//Initiate PHPMailer
	$mail=new PHPMailer();
	if (isset($_SESSION["user"]) && isset($_SESSION["pass"]))
	{
		$api=new api($_SESSION["user"],$_SESSION["pass"]);
	}
	else
	{
		$api=new api("","");
	}
	$api->auth();
	$mysqli=$api->get_conn();
	$ok=$api->is_school();
	if (!$ok)
	{
		echo "You are not authenticated to access this page";
		//echo "Test: ".$test;
		header("Location: index.php");
	}
	else
	{
		//Authenticated
		
		//Update school information
		$school_name=mysqli_real_escape_string($mysqli,$_POST["school_name"]);
		$school_address=mysqli_real_escape_string($mysqli,$_POST["school_address"]);
		$school_country=mysqli_real_escape_string($mysqli,$_POST["school_country"]);
		$num_proj=intval(mysqli_real_escape_string($mysqli,$_POST["school_num_proj"]));
		$sql="insert into wc_school(name,address,country,project_no) values('".$school_name."','".$school_address."','".$school_country."','".$num_proj."');";
		$api->do_sqli($sql);
		$sql="select * from wc_school where name='$school_name' AND address='$school_address' AND country='$school_country' AND project_no='$num_proj';";
		//echo $sql."<br/>";
		$res=$api->do_sqli($sql);
		while ($r=mysqli_fetch_array($res))
		{
			$school_id=$r[0];
		}
		//echo "Your school is id: ".$school_id."<br/>";
		//Update Project Information
		//Update Project 1 Info
		$proj_name=mysqli_real_escape_string($mysqli,$_POST["project1_title"]);
		$proj_abstract=mysqli_real_escape_string($mysqli,$_POST["project1_abstract"]);
		$proj_cat1=mysqli_real_escape_string($mysqli,$_POST["project1_cat1"]);
		$proj_cat2=intval(mysqli_real_escape_string($mysqli,$_POST["project1_cat2"]));
		$sql="insert into wc_projects(title,abstract,cat1,cat2,school) values('".$proj_name."','".$proj_abstract."','$proj_cat1','$proj_cat2','$school_id');";
		$api->do_sqli($sql);
		$sql="select * from wc_projects where title='$proj_name' AND abstract='$proj_abstract' AND cat1='$proj_cat1' AND cat2='$proj_cat2' AND school='$school_id';";
		//echo $sql."<br/>";
		$res=$api->do_sqli($sql);
		while ($r=mysqli_fetch_array($res))
		{
			$proj1_id=$r[0];
		}
		//echo "Your project1 is id: ".$proj1_id."<br/>";
		if ($num_proj==2)
		{
			//Update Project 2 Info
			$proj_name=mysqli_real_escape_string($mysqli,$_POST["project2_title"]);
			$proj_abstract=mysqli_real_escape_string($mysqli,$_POST["project2_abstract"]);
			$proj_cat1=mysqli_real_escape_string($mysqli,$_POST["project2_cat1"]);
			$proj_cat2=intval(mysqli_real_escape_string($mysqli,$_POST["project2_cat2"]));
			$sql="insert into wc_projects(title,abstract,cat1,cat2,school) values('".$proj_name."','".$proj_abstract."','$proj_cat1','$proj_cat2','$school_id');";
			$api->do_sqli($sql);
			$sql="select * from wc_projects where title='$proj_name' AND abstract='$proj_abstract' AND cat1='$proj_cat1' AND cat2='$proj_cat2' AND school='$school_id';";
			//echo $sql."<br/>";
			$res=$api->do_sqli($sql);
			while ($r=mysqli_fetch_array($res))
			{
				$proj2_id=$r[0];
			}
			//echo "Your project2 is id: ".$proj2_id."<br/>";
		}
		//Update User Information
		//Teachers
		$school_pass=mysqli_real_escape_string($mysqli,$_POST["school_pass"]);
		$teacher_num=intval(mysqli_real_escape_string($mysqli,$_POST["teacher_num"]));
		$str = "Dear ".$_POST["teacher1_salutation"]." ".$_POST["teacher1_name"].",<br/><br/>This is an auto-generated email to confirm your conference registration. Please also take note of the following login information for future logins:<br/><br/>";
		$str .= "Username: ".$_SESSION["user"]." Password: ".$school_pass."<br/>";
		$stu_cnt=0;
		for ($i=1; $i<=$teacher_num; $i++)
		{
			$t_pass=gen_pwd();
			$t_name=mysqli_real_escape_string($mysqli,$_POST["teacher".$i."_name"]);
			$t_sal=mysqli_real_escape_string($mysqli,$_POST["teacher".$i."_salutation"]);
			$t_gender=mysqli_real_escape_string($mysqli,$_POST["teacher".$i."_gender"]);
			$t_email=mysqli_real_escape_string($mysqli,$_POST["teacher".$i."_email"]);
			$t_passport=mysqli_real_escape_string($mysqli,$_POST["teacher".$i."_passport"]);
			$t_nationality=mysqli_real_escape_string($mysqli,$_POST["teacher".$i."_nationality"]);
			$t_subj=mysqli_real_escape_string($mysqli,$_POST["teacher".$i."_subj"]);
			$t_contact=mysqli_real_escape_string($mysqli,$_POST["teacher".$i."_contact"]);
			$t_bd=mysqli_real_escape_string($mysqli,$_POST["teacher".$i."_bd"]);
			$t_dreq=mysqli_real_escape_string($mysqli,$_POST["teacher".$i."_dreq"]);
			$t_shirtsize=mysqli_real_escape_string($mysqli,$_POST["teacher".$i."_shirtsize"]);
			$t_nokname=mysqli_real_escape_string($mysqli,$_POST["teacher".$i."_nokname"]);
			$t_nokrlt=mysqli_real_escape_string($mysqli,$_POST["teacher".$i."_nokrlt"]);
			$t_nokcontact=mysqli_real_escape_string($mysqli,$_POST["teacher".$i."_nokcontact"]);
			$t_mcon=mysqli_real_escape_string($mysqli,$_POST["teacher".$i."_mcon"]);
			$t_dallergy=mysqli_real_escape_string($mysqli,$_POST["teacher".$i."_dallergy"]);
			$t_pexp=mysqli_real_escape_string($mysqli,$_POST["teacher".$i."_pexp"]);
			$t_is_p=mysqli_real_escape_string($mysqli,$_POST["teacher".$i."_is_p"]);
			$t_uname=preg_replace('/\s+/', '', $t_name);
			$t_uname=strtolower($t_uname);
			if (in_array($t_nationality,$visa_req))
			if (in_array($t_nationality,$visa_req))
			{
				$id+=1;
				//echo "Requires Visa :-(";
				require("pdf_fgen.php");
				$mail->addAttachment('pdfs/visa_documentation_'.$school_id.$id.'.pdf');
			}
			$t_auth=2;
			$str.="<p>Name (Accompanying Teacher): ".$t_name."</p>" ;
			$t_pass=md5($t_pass);
			$mail->addAddress($t_email, $t_name);
			$sql="insert into wc_users (name,pass,auth,registered,email,salutation,d_name,gender,passport,nationality,subj,contact_no,dob,dreq,shirt_size,nok_name,nok_relationship,nok_contact_no,med_condition,med_allergy,school,project,pexp,is_p) values('$t_uname','$t_pass','$t_auth','0','$t_email','$t_sal','$t_name','$t_gender','$t_passport','$t_nationality','$t_subj','$t_contact','$t_bd','$t_dreq','$t_shirtsize','$t_nokname','$t_nokrlt','$t_nokcontact','$t_mcon','$t_dallergy','$school_id','-1','$t_pexp','$t_is_p');";
			$api->do_sqli($sql);
		}
		//Students
		$student_num=intval(mysqli_real_escape_string($mysqli,$_POST["student_proj1_num"]));
		$stu_cnt+=$student_num;
		//echo "$student_num students<br/>";
		for ($i=1; $i<=$student_num; $i++)
		{
			$t_pass=gen_pwd();
			$t_name=mysqli_real_escape_string($mysqli,$_POST["student".$i."_name"]);
			$t_name=mysqli_real_escape_string($mysqli,$_POST["student".$i."_name"]);
			$t_gender=mysqli_real_escape_string($mysqli,$_POST["student".$i."_gender"]);
			$t_email=mysqli_real_escape_string($mysqli,$_POST["student".$i."_email"]);
			$t_passport=mysqli_real_escape_string($mysqli,$_POST["student".$i."_passport"]);
			$t_nationality=mysqli_real_escape_string($mysqli,$_POST["student".$i."_nationality"]);
			$t_subj=mysqli_real_escape_string($mysqli,$_POST["student".$i."_subj"]);
			$t_contact=mysqli_real_escape_string($mysqli,$_POST["student".$i."_contact"]);
			$t_bd=mysqli_real_escape_string($mysqli,$_POST["student".$i."_bd"]);
			$t_dreq=mysqli_real_escape_string($mysqli,$_POST["student".$i."_dreq"]);
			$t_shirtsize=mysqli_real_escape_string($mysqli,$_POST["student".$i."_shirtsize"]);
			$t_nokname=mysqli_real_escape_string($mysqli,$_POST["student".$i."_nokname"]);
			$t_nokrlt=mysqli_real_escape_string($mysqli,$_POST["student".$i."_nokrlt"]);
			$t_nokcontact=mysqli_real_escape_string($mysqli,$_POST["student".$i."_nokcontact"]);
			$t_mcon=mysqli_real_escape_string($mysqli,$_POST["student".$i."_mcon"]);
			$t_dallergy=mysqli_real_escape_string($mysqli,$_POST["student".$i."_dallergy"]);
			$t_pexp=mysqli_real_escape_string($mysqli,$_POST["student".$i."_pexp"]);
			$t_uname=preg_replace('/\s+/', '', $t_name);
			$t_uname=strtolower($t_uname);
			if (in_array($t_nationality,$visa_req))
			{
				$id+=1;
				require("pdf_fgen.php");
				$mail->addAttachment('pdfs/visa_documentation_'.$school_id.$id.'.pdf');
			}
			$t_auth=3;
			$str.="<p>Name: ".$t_name/*." Username: ".$t_uname." Password: ".$t_pass*/."</p>";
			$t_pass=md5($t_pass);
			$sql="insert into wc_users (name,pass,auth,registered,email,salutation,d_name,gender,passport,nationality,subj,contact_no,dob,dreq,shirt_size,nok_name,nok_relationship,nok_contact_no,med_condition,med_allergy,school,project,pexp) values('$t_uname','$t_pass','$t_auth','0','$t_email','$t_salutation','$t_name','$t_gender','$t_passport','$t_nationality','$t_subj','$t_contact','$t_bd','$t_dreq','$t_shirtsize','$t_nokname','$t_nokrlt','$t_nokcontact','$t_mcon','$t_dallergy','$school_id','$proj1_id','$t_pexp');";
			//echo $sql."<br/>";
			$api->do_sqli($sql);
		}
		$student_num=intval(mysqli_real_escape_string($mysqli,$_POST["student_proj2_num"]));
		if ($num_proj==1)
		{
			$student_num=0;
		}
		$stu_cnt+=$student_num;
		for ($i=5; $i<=$student_num+4; $i++)
		{
			$t_pass=gen_pwd();
			$t_name=mysqli_real_escape_string($mysqli,$_POST["student".$i."_name"]);
			//$str.="<p>".$t_pass." : ".$t_name."</p>";
			$t_pass=md5($t_pass);
			$t_name=mysqli_real_escape_string($mysqli,$_POST["student".$i."_name"]);
			$t_gender=mysqli_real_escape_string($mysqli,$_POST["student".$i."_gender"]);
			$t_email=mysqli_real_escape_string($mysqli,$_POST["student".$i."_email"]);
			$t_passport=mysqli_real_escape_string($mysqli,$_POST["student".$i."_passport"]);
			$t_nationality=mysqli_real_escape_string($mysqli,$_POST["student".$i."_nationality"]);
			$t_subj=mysqli_real_escape_string($mysqli,$_POST["student".$i."_subj"]);
			$t_contact=mysqli_real_escape_string($mysqli,$_POST["student".$i."_contact"]);
			$t_bd=mysqli_real_escape_string($mysqli,$_POST["student".$i."_bd"]);
			$t_dreq=mysqli_real_escape_string($mysqli,$_POST["student".$i."_dreq"]);
			$t_shirtsize=mysqli_real_escape_string($mysqli,$_POST["student".$i."_shirtsize"]);
			$t_nokname=mysqli_real_escape_string($mysqli,$_POST["student".$i."_nokname"]);
			$t_nokrlt=mysqli_real_escape_string($mysqli,$_POST["student".$i."_nokrlt"]);
			$t_nokcontact=mysqli_real_escape_string($mysqli,$_POST["student".$i."_nokcontact"]);
			$t_mcon=mysqli_real_escape_string($mysqli,$_POST["student".$i."_mcon"]);
			$t_dallergy=mysqli_real_escape_string($mysqli,$_POST["student".$i."_dallergy"]);
			$t_pexp=mysqli_real_escape_string($mysqli,$_POST["student".$i."_pexp"]);
			$t_uname=preg_replace('/\s+/', '', $t_name);
			$t_uname=strtolower($t_uname);
			$t_auth=3;
			if (in_array($t_nationality,$visa_req))
			{
				$id+=1;
				require("pdf_fgen.php");
				$mail->addAttachment('pdfs/visa_documentation_'.$school_id.$id.'.pdf');
			}
			$str.="<p>Name: ".$t_name/*." Username: ".$t_uname." Password: ".$t_pass*/."</p>";
			$t_pass=md5($t_pass);
			$sql="insert into wc_users (name,pass,auth,registered,email,salutation,d_name,gender,passport,nationality,subj,contact_no,dob,dreq,shirt_size,nok_name,nok_relationship,nok_contact_no,med_condition,med_allergy,school,project,pexp) values('$t_uname','$t_pass','$t_auth','0','$t_email','$t_salutation','$t_name','$t_gender','$t_passport','$t_nationality','$t_subj','$t_contact','$t_bd','$t_dreq','$t_shirtsize','$t_nokname','$t_nokrlt','$t_nokcontact','$t_mcon','$t_dallergy','$school_id','$proj2_id','$t_pexp');";
			//echo $sql."<br/>";
			$api->do_sqli($sql);
		}
		if ($school_country=="Singapore")
		{
			$str.="<br/>The registration fee for the conference is SGD$100/student and SGD$0/teacher for the duration of the conference. The camp registration fee will cover accommodation, meals and transportation within the camp programme. Please make the payment of SGD$";
		}
		else
		{
			$str.="<br/>The registration fee for the conference is SGD$350/student and SGD$500/teacher for the duration of the conference. The camp registration fee will cover accommodation, meals and transportation within the camp programme. Please make the payment of SGD$";
		}
		$cost=0;
		if ($school_country=="Singapore")
		{
			$cost=($teacher_num*0+$stu_cnt*100);
		}
		else
		{
			$cost=($teacher_num*500+$stu_cnt*350);
		}
		$str.=$cost;
		$str.=" via international bank wire to:<br/><br/>";
		$str.="<b>Account name:</b> Raffles Institution<br/><b>Account number:</b> 0709009018<br/><b>Bank name:</b> DBS Bank Ltd<br/><b>Address:</b> DBS BANK<br/>12 Marina Boulevard<br/>DBS Asia Central<br/>Marina Bay Financial Centre Tower 3<br/>Singapore 018892<br/><b>DBS SWIFT BIC Code:</b> DBSSSGSG<br/><br/>";
		$str.="Please indicate the name of your school, and that you are making payment for the international water conference. Please be reminded that all bank charges should be borne by your school.<br/><br/>";
		$str.="Deadline for payment of conference is 15th March 2014.<br/><br/><br/>";
		$str.="Please feel free to contact Dr. Tan Guoxian at guoxian.tan@ri.edu.sg, if you have any enquiries.<br/><br/>Thank you, and we look forward to having you with us at the water conference.<br/><br/><br/>Yours sincerely,<br/>Organizing committee of water conference";
		$mail->IsSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPDebug = 0;
		$mail->Port = 587;
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = "tls";
		//$mail->Username = "gqwu3000";
		//$mail->Password = "97560471wuguanqun";
		$mail->Username = "riwaterconference2014";
		$mail->Password = "waterislife";
		$mail->SetFrom('riwaterconference2014@gmail.com', 'Dr. Tan Guoxian');
		$mail->addCC('guoxian.tan@ri.edu.sg');
		$mail->addCC('tzeyang.wong@ri.edu.sg');
		$mail->AddReplyTo("gqwu3000@gmail.com","Wu Guanqun");
		$mail->AddReplyTo('guoxian.tan@ri.edu.sg', 'Dr. Tan Guoxian');
		$mail->AddReplyTo("tzeyang.wong@ri.edu.sg","Mr. Wong Tze Yang");
		$mail->Subject    = "Successful Registration for RI-Maurick Water Conference 2014";
		$mail->isHTML(true);
		$mail->Body    = $str;
		$mail->AltBody = $str;
		//echo "Haii";
		//Register school
		$sql="select * from wc_users where name='".$_SESSION["user"]."' AND pass='".md5($_SESSION["pass"])."';";
		//echo $sql."<br/>";
		if(!$mail->send()) {
		   echo 'Message could not be sent.';
		   echo 'Mailer Error: ' . $mail->ErrorInfo;
		   echo "<a href='http://www.waterislife2014.com'>Click this to go back to Website</a>";
		   die();
		}
		else
		{
			echo "Thank you for registering. An email will be sent to your email account<br/>";			
		}
		$res=$api->do_sqli($sql);
		$cnt=0;
		while ($r=mysqli_fetch_array($res))
		{
			$cnt+=1;
			$user_id=$r[0];
		}
		$school_pass=md5($school_pass);
		$sql="update wc_users set registered='1', pass='$school_pass' where id='$user_id';";
		$api->do_sqli($sql);
		
		//Unlink Files
		for ($i=1; $i<=$id; $i++)
		{
			unlink("pdfs/visa_documentation_".$school_id.$i.".pdf");
		}
		//Logout
		unset($_SESSION["user"]);
		unset($_SESSION["pass"]);
		echo "Please refer to the email for login information, visa support documents if any, and payment details. Kindly email guoxian.tan@ri.edu.sg, if you require any clarifications.<br/>";
		echo "<a href='http://www.waterislife2014.com'>Click this to go back to the conference website</a>";
	}
?>