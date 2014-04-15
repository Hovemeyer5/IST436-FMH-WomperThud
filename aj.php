<?php
    session_start();
    if(strpos($_SERVER['HTTP_REFERER'], "?r") !== FALSE)
    {
	$pos = strpos($_SERVER['HTTP_REFERER'], "?r");
	$_SERVER['HTTP_REFERER'] = substr($_SERVER['HTTP_REFERER'],0,$pos);
		      
    }
    
    require_once('inc/config.php');
    if(isset($_POST['action']) or isset($_GET['action']))
    {
	
	if(isset($_POST['action']))
	    $action = $_POST['action'];
	else
	    $action = $_GET['action'];
	
	if($action == "lgn" && isset($_POST['username']) && isset($_POST['psw']))
	{
	    $loginFailed ="";
	    $result = "";
	    $results = $db->select("user", "u_s", "u_username = '". $_POST['username']."'");
	    if($results == "")
	    {	
		//logined failed message = e 7
		$loginFailed = "?e=7";
		
	    }
	    else
	    {
		    $testPW = hash("ripemd160", $_POST['psw'] . $results[0]['u_s']);
		    $result = $db->select("user", "u_id", 
		    "u_username = '". htmlspecialchars($_POST['username']) . "' AND u_pw = '" . $testPW . "'"); 
		    if($result == "") 				
		    {
			//logined failed e =7
			$loginFailed = "?e=7";			
		    } 				
		    else 				
		    { 
			$_SESSION['user'] = $result[0]['u_id'];
		    } 
	    }
	    
	    header("location:" . 'index.php'. $loginFailed);
	}
	elseif($action == "lgout")
	{
	    //logout
	    
	    session_destroy();
	    
	    //back to home
	    header("location: index.php");
	}
	elseif($action == "su"
		and isset($_POST['fname'])
		and isset($_POST['mi']) 
		and isset($_POST['lname'])
		and isset($_POST['dobm'])
		and isset($_POST['dobd'])
		and isset($_POST['doby'])
		and isset($_POST['street'])
		and isset($_POST['city']) 
		and isset($_POST['zip'])
		and isset($_POST['state'])
		and isset($_POST['doby'])  
		and isset($_POST['email'])
		and isset($_POST['cemail'])
		and isset($_POST['phone']) 
		and isset($_POST['psw'])
		and isset($_POST['cpsw'])
		and isset($_POST['username'])
		
		and isset($_POST['busName'])
		and isset($_POST['bemail'])
		and isset($_POST['cbemail'])
		and isset($_POST['bphone'])
		and isset($_POST['bacode'])
		and isset($_POST['busSel'])
		and isset($_POST['sacode'])
		)
	{
	    //all general informatin was sent
	    //check if student or business informatin was sent
	    $break = true;
	    
	    //trim data
	    $fname = trim($_POST['fname']);
	    $mi = trim($_POST['mi']);
	    $lname = trim($_POST['lname']);
	    $dobm = trim($_POST['dobm']);
	    $dobd = trim($_POST['dobd']);
	    $doby = trim($_POST['doby']);
	    $street = trim($_POST['street']);
	    $city = trim($_POST['city']);
	    $zip = trim($_POST['zip']);
	    $state = trim($_POST['state']);
	    $email = trim($_POST['email']);
	    $cemail = trim($_POST['cemail']);
	    $phone = preg_replace('/[^\d]/','',trim($_POST['phone'])); 
	    $psw = trim($_POST['psw']);
	    $cpsw = trim($_POST['cpsw']);
	    $username= trim($_POST['username']);
	    if(isset($_POST['aType']))
	    {
		$aType = trim($_POST['aType']);
	    }
	    $busName = trim($_POST['busName']);
	    $bemail = trim($_POST['bemail']);
	    
	    $cbemail = trim($_POST['cbemail']);
	    $bphone = preg_replace('/[^\d]/','',trim($_POST['bphone'])); 
	    $bstreet = trim($_POST['bstreet']);
	    $bcity = trim($_POST['bcity']);
	    $bstate = trim($_POST['bstate']);
	    $bzip = trim($_POST['bzip']);
	    
	    $bacode = trim($_POST['bacode']);
	    $busSel = trim($_POST['busSel']);
	    $sacode = trim($_POST['sacode']);
	    
	    $result = $db->select("user", "u_id", "u_username = '". $username ."'"); 
	    
	    if($fname == ""
		or $lname == ""
		or $email == ""
		or $cemail == ""
		or $psw == ""
		or $cpsw == ""
		or $phone == ""
		or $username == ""
		or $street == ""
		or $city == ""
		or $zip == ""
		or $state == ""
		or ($aType != "b" and $aType != "s")
		)
	    {
		
		//error one = required info not sent
		header("location:" . $_SERVER['HTTP_REFERER'] . '?r=1');
	    }
	    elseif($result !== "")
	    {
		
		//error two = username already taken
		header("location:" . $_SERVER['HTTP_REFERER']. '?r=2');
	    }
	    elseif(($aType == "b" and
		   ($busName == ""
		    or $bacode == ""))
		    or ($aType == "s" and
		    ($busSel == ""
		     or $sacode == "")))
	    {
		
		//error one = required info not sent
		header("location:" . $_SERVER['HTTP_REFERER'] . '?r=1');
	    }
	    elseif($aType == "b"
		   and
		    (
		     (
		      !isset($_POST['busEmPhCh'])
		      and ($cbemail == "" or $bemail == "" or $bphone == "")
		      )
		    or
		     (
			!isset($_POST['busAddCh'])
			and ($bstreet == "" or $bcity == "" or $bstate == "" or $bzip == "")
		     )
		   )
		)
	    {
		//error one = required info not sent
		header("location:" . $_SERVER['HTTP_REFERER'] . '?r=1');
	    }
	    elseif($email != $cemail)
	    {
		//eror three = user emails don't match
		header("location:" . $_SERVER['HTTP_REFERER']. '?r=3');
	    }
	    elseif($aType == "b" and $bemail != "" and $bemail != $bcemail)
	    {
		//error 4 = businesses emails don't match
		header("location:" . $_SERVER['HTTP_REFERER']. '?r=4');
	    }
	    elseif($psw != $cpsw)
	    {
		//error 5 = passwords don't match
		header("location:" . $_SERVER['HTTP_REFERER']. '?r=5');
	    }
	    else
	    {
		
		//if student - check if good access 
		$access == false;
		if($aType == "s")
		{
		    //get business $busSel with accesscode $sacode
		    $result = $db->select("business", "bus_id", "bus_id = '". $busSel ."' and bus_code ='".$sacode."'"); 
		    if($result != "")
		    {
			$access = true;
		    }
		}
		//enter user address
		$userAdd = $db->insert("address", "'".$db->escape($street)."',
			    '".$db->escape($city)."',
			    '".$db->escape($state)."',
			    '".$db->escape($zip)."'",
			    "add_street, add_city, add_state, add_zip");
		
		
		$dateOfBirth = "'".$doby."-".str_pad($dobm, 2, "0", STR_PAD_LEFT)."-".str_pad($dobd, 2, "0", STR_PAD_LEFT)."'";
			    
		$salt = hash("ripemd160", mcrypt_create_iv(40));
		$passw = hash("ripemd160", $psw . $salt);
		$userid = $db->insert("user", "'".$db->escape($fname)."',
			    '".$db->escape($mi)."',
			    '".$db->escape($lname)."',
			    '".$db->escape($email)."',
			    '".$db->escape($phone)."',
			    '".$db->escape($username)."',
			    ".$userAdd.",
			    $dateOfBirth,
			    '".$passw."', '".$salt."'" ,
			    "u_fname, u_mi, u_lname, u_email,
			    u_phone, u_username, u_add, u_dob,
			    u_pw, u_s");
		
		//add user to business or bus/student table
		if($aType == "b")
		{
		    $address = $userAdd;
		    //other possible variables
		    $other = '';
		    $otherDenoted = '';
		    //add possibly null columns
		    if(!isset($_POST['busEmPhCh']))
		    {
			if($bemail != "")
			{
			    $other .= "'".$db->escape($bemail)."', ";
			    $otherDenoted .= " bus_email, ";
			}
		    }
		    else
		    {
			$other .= "'".$db->escape($email)."', ";
			$otherDenoted .= " bus_email, ";
		    }
		    if(!isset($_POST['busEmPhCh']))
		    {
			if($bus_phone != "")
			{
			    $other .= "'".$db->escape($bphone)."', ";
			    $otherDenoted .= "bus_phone, ";
			}
		    }
		    else
		    {
			$other .= "'".$db->escape($phone)."', ";
			$otherDenoted .= "bus_phone, ";
		    }
		    //address Stuff Here
		    if(!isset($_POST['busAddCh']))
		    {
			$address = $db->insert("address", "'".$db->escape($bstreet)."',
			    '".$db->escape($bcity)."',
			    '".$db->escape($bstate)."',
			    '".$db->escape($bzip)."'",
			    "add_street, add_city, add_state, add_zip");
		    }
		    //insert into table
		    $businessid = $db->insert("business", "'".$db->escape($busName)."',
			".$userid.",
			".$address.",
			".$other."
			'".$bacode."'",
			"bus_name, bus_owner, bus_add, ". $otherDenoted." bus_code");
		}
		else{
		    $studentsuccess = "";
		    if($access)
		    {
			//insert into the tables
			$db->insert("bus_student",
				    $busSel.", ".$userid,
				    "bus_id, u_id");
		    }
		    else
		    {
			//note success - error 6 = not joined to business
			$studentsuccess = "?r=6";
		    }
		}
		//set user logged in
		$_SESSION['user'] = $userid;
		header("location:" . 'index.php'.$studentsuccess);
	    }
	    
	}
	elseif($action == "checkUName")
	{
	    $checkUN = $db->select("user", "u_id", "u_username = '". $_POST['username'] ."'");
	    if($checkUN == "")
		echo "true";
	    else
		echo "false";
	}
	else{
	    echo "Uh Oh! Something went wrong. Please return to the <a href='index.php'>home page</a>..";
	}
    }
    else
    {
	echo "Uh Oh! Something went wrong. Please return to the <a href='index.php'>home page</a>.";
    }
	
?>

