<!DOCTYPE html PUBLIC>
<head>
<!--#Andrew - Added the viewport for baseline testing-->
<meta name="viewport" content="width=device-width", initial-scale="1">
<link rel="stylesheet" href="../../NerdLair/CSS/NerdLair.css" />
<script type="text/javascript">
function displayDate()
{
	
	var d = new Date();
	var x = document.getElementById("copyrighthere");
	//document.write("Copyright &#169;");
	x.innerHTML=d.getFullYear();
}
</script>
<title>Create an Account</title>
</head>

<body>
<h1>Create an Account</h1>
<form name="input" action="signup.php"signup.php" method="POST">
Please enter your email address: <br>
<input type="text" name="emailAddress" id="emailAddress" placeholder="youremail@gmail.com" required><br>
 Please enter a password: <br>
 <input type="password" name="password" id="password" required><br>
<input type="submit" value="Submit"><br>
</form>

<p id="copyright">
Copyright &#169; 2014 - 
<span id="copyrighthere"></span>

<script type="text/javascript">
//calls the function to display the year
displayDate();
</script>
<br>
Site &#169; McCallister, Hovemeyer, and Foster.
</p>
</body>
</html>