<?php
require_once("error_report.php");
class api
{
	private $stuff=array();
	
	function __construct($name,$password)
	{
		global $stuff;
		require("db_conn.php");
		$stuff["conn"]=$mysqli;
		$stuff["user"]=mysqli_real_escape_string($stuff["conn"],$name);
		$stuff["pass"]=mysqli_real_escape_string($stuff["conn"],$password);
		if ($stuff["user"]!=$name || $stuff["pass"]!=$password)
		{
			$stuff["nicetry"]=true;
		}
		else
		{
			$stuff["nicetry"]=false;
		}
		$stuff["passnomd5"]=$stuff["pass"];
		$stuff["pass"]=md5($stuff["pass"]);
	}
	
	public function auth()
	{
		global $stuff;
		$stuff["auth"]=-1;
		if ($stuff["user"]=="" && $stuff["pass"]=="")
		{
			return "Problem Logging In! Ensure you keyed in the right Username(Your email if you are a representing a school) and Password!";
		}
		$sql="select * from wc_users where name='".$stuff["user"]."' AND pass='".$stuff["pass"]."';";
		$res=$this->do_sqli($sql);
		$cnt=0;
		while ($r=mysqli_fetch_array($res))
		{
			$cnt+=1;
			$_SESSION["user"]=$stuff["user"];
			$_SESSION["pass"]=$stuff["passnomd5"];
			$stuff["auth"]=$r[3];
			$stuff["reg"]=$r[4];
		}
		if ($cnt>1)
		{
			$stuff["auth"]=-1;
			return "Nice try...";
		}
		else if ($cnt==0)
		{
			if ($stuff["nicetry"])
			{
				return "Nice try...";
			}
			$stuff["auth"]=-1;
			return "Problem Logging In! Ensure you keyed in the right Username(Your email if you are a representing a school) and Password!";
		}
		return "Success";
	}
	
	function do_sqli($sql)
	{
		global $stuff;
		if (!$res=mysqli_query($stuff["conn"],$sql))
		{
			//echo $res;
			die("Error: ".mysqli_error($stuff["conn"]));
		}
		return $res;
		
	}
	
	function get_conn()
	{
		global $stuff;
		return $stuff["conn"];
	}
	
	function is_auth($levelreq,$redir)
	{
		global $stuff;
		//echo $stuff["auth"];
		if ($stuff["auth"]==-1)
		{
			if ($redir==1)
			{
				$this->not_auth();
			}
			return 0;
		}
		else if ($stuff["auth"]>$levelreq)
		{
			if ($redir==1)
			{
				$this->not_auth();
			}
			return 0;
		}
		return 1;
	}
	
	function not_auth()
	{
		//echo "Extra Header";
		header("Location: login.php");
	}
	
	function get_msg()
	{
		global $stuff;
		$sql="select * from wc_info";
		$res=$this->do_sqli($sql);
		while ($r=mysqli_fetch_array($res))
		{
			echo "<div><h2>".$r[1]."</h2><pre>".$r[2]."</pre><p> Posted By: ".$r[3]." on ".$r[4]."</p></div>";
		}
	}
	
	function is_school()
	{
		global $stuff;
		//echo ($stuff["auth"]);
		//echo ($stuff["reg"]);
		return ($stuff["auth"]==4 /*&& $stuff["reg"]==0*/);
	}
	
	function was_school()
	{
		global $stuff;
		//echo ($stuff["auth"]);
		//echo ($stuff["reg"]);
		return ($stuff["auth"]==4 && $stuff["reg"]==1);
	}
}
?>