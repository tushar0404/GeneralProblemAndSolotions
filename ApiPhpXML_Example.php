<?php

 $host="localhost";
 $user="username";
 $pass="password";
 $dbName="dbName";

 $con=mysql_connect($host,$user,$pass) or die("failed connecting  server");
 $dbHandle=mysql_select_db($dbName,$con) or die("failed selecting db");

/*
 * Retrive User info through username and password
 * it will take parameter through post method
 * the data will be send in xml format
*/

  // Getting Username and PAssword
  $username=$_POST['username'];
  $password=$_POST['password'];

  $queryuser = "SELECT * FROM tbl_user where username='$username'";
  $resultuser = mysql_query($queryuser);
 
  $querypass = "SELECT * FROM tbl_user where password='$password'";
  $resultpass = mysql_query($querypass);
 
  // Checking If username and password exist in database or not

      // Both username and password are invalid 
  	  if(mysql_num_rows($resultuser)==0 && mysql_num_rows($resultpass)==0)
	  {
	 	$xml = "<?xml version='1.0' encoding='utf-8' ?>";
	 	$xml .= "<ROOT>";
		$xml .= "<RESPONSE>INVALID USERNAME AND PASSWORD</RESPONSE>";
	 	$xml .= "</ROOT>";
		echo $xml;						 
	  }
	  // Only username is invalid
	  elseif(mysql_num_rows($resultuser)==0)
	  {
	  	$xml = "<?xml version='1.0' encoding='utf-8' ?>";
	 	$xml .= "<ROOT>";
		$xml .= "<RESPONSE>INVALID USERNAME</RESPONSE>";
	 	$xml .= "</ROOT>";
		echo $xml;
	  }
	  //Only password is invalid
	  elseif(mysql_num_rows($resultpass)==0)
	  {
	  	$xml = "<?xml version='1.0' encoding='utf-8' ?>";
	 	$xml .= "<ROOT>";
		$xml .= "<RESPONSE>INVALID PASSWORD</RESPONSE>";
	 	$xml .= "</ROOT>";
		echo $xml;
	  }
      // Displaying User Info  	  
	  else 
	  {
	 	  $result=mysql_query("select *from tbl_user where username='$username'");
	     	  while($row=mysql_fetch_array($result)){
			 $xml = "<?xml version='1.0' encoding='utf-8' ?>";
			 $xml .= "<ROOT>";	
			 $xml .= "<USER_ID><![CDATA[{$row['userId']}]]></USER_ID>";
			 $xml .= "<FIRST_NAME><![CDATA[{$row['firstName']}]]></FIRST_NAME>";								 
			 $xml .= "<LAST_NAME><![CDATA[{$row['lastName']}]]></LAST_NAME>";
			 $xml .= "<USER_MOOD><![CDATA[{$row['userMood']}]]></USER_MOOD>";
			 $xml .= "<EMAIL><![CDATA[{$row['email']}]]></EMAIL>";
			 $xml .= "<CONTACT><![CDATA[{$row['contact']}]]></CONTACT>";					        
			 $xml .= "</ROOT>";	 	
			 echo $xml;							
		}   
	  }
	 

?>
