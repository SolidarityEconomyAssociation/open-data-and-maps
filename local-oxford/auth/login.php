<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>Login</title> 
    </head>

    <body>
        <div class="centered">
           
            <?php if(isset($_GET['id'])){$id = $_GET['id']; if($id=='nope'){echo "<p id='login-header'>Email/Password didn't work</p>";}}else {echo'            <a href="http://solidarityeconomy.coop"><img id="splash" src="logo.png" title="Solidarity Economy Association" /></a>';}; ?>
            <form action="start.php" method="POST" id="form">
                <label class="smaller">Email<br/></label>
                <input type="text" name="user"/><br/>
                <label class="smaller">Password<br/></label>
                <input type="password" name="password"><br/>
                <input type="submit" value="LOG IN" class="button" /><br/><br/>
                <a class="button" href="register.php">Register a new account</a><br/>
                <a class="button" href="forgot.php">Get a new password</a>
            </form>
        </div>
    </body>
</html> 