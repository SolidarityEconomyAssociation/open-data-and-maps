<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="styles.css">

        <title>Registration Complete</title>

    </head>
    <body>

<?php	
		require 'password.php';
	

		// Connect to database
		include('db_login.php');

		$user = mysqli_real_escape_string($conn,$_POST["user"]);
		$secret = $_POST["password"];	



		// Check if user already exists
		$checkuser =  "SELECT * FROM users WHERE email='".$user."';";

        if ($statemt = mysqli_prepare($conn, $checkuser)) {
			mysqli_stmt_execute($statemt); 
			$result0 = mysqli_stmt_get_result($statemt);
			}; 		
		
		if(mysqli_num_rows($result0) == 1){
		echo "<p>Sorry that email is already in use, <a href='forgot.php'>forget your password?</a> Or back to <a href='login.php'>Login</a>.</p>";}

		else{
		// Hash password and add to database (id,email,password,verification,verified)

		$hasher = new PasswordHash(8, false);
		if (strlen($secret) > 72) { die("Password must be 72 characters or less"); };
		$hash = $hasher->HashPassword($secret);

		
		$random = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1,5))),1,10);

		//Secure from SQL injection

		if ($stmt = mysqli_prepare($conn, 'INSERT INTO users (email, password, verification) VALUES(?,?,?);')) {

   		mysqli_stmt_bind_param($stmt, "sss", $user, $hash, $random);

    	mysqli_stmt_execute($stmt); };

		//Send an email
		$subject = "Oxford Solidarity Economy Mapping";
		$msg = "Hello!,\nWelcome to the Oxford Map, to verify your email and add yourself to the map click the following link, Thanks Very Much!\nhttp://oxford.solidarityeconomics.org/verify.php?id=".$random;
 		$headers = 'From: dan@solidarityeconomics.org' . "\r\n" .
    		'X-Mailer: PHP/' . phpversion();
 		mail($user,$subject,$msg,$headers);

		echo "<h2>Thanks For Registering! You've been sent an email with a link for verification.</h2>";
		};
	
			
		mysqli_close($conn);

					
		?>


 
  			<a href="login.php">Back to Login</a>
  		 
    </body>
</html> 

