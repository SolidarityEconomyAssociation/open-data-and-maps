<?php  session_save_path('/home/pareccoc/cgi-bin/tmp');
		session_start();
		session_regenerate_id();
		if(!isset($_SESSION['user']))      // if there is no valid session
			{
    			header("Location: login.php");
    			exit();
			};
 		
        // Connect to database
        include('db_login.php');
        $user = $_SESSION['user'];
        
        //Process data to be uploaded
        isset($_POST['sentence']) ? $sentence = $_POST['sentence'] : $sentence = '';
        isset($_POST['description']) ? $description = $_POST['description'] : $description = '';
        isset($_POST['provides']) ? $provides = $_POST['provides'] : $provides = ['','',''];
        isset($_POST['topic']) ? $topic = $_POST['topic'] : $topic = ['','',''];
        isset($_POST['identity']) ? $identity = $_POST['identity'] : $identity = ['','',''];
        isset($_POST['interaction']) ? $interaction = $_POST['interaction'] : $interaction = ['','',''];

        //Make sure all arrays are exactly of size 3
        $provides = array_slice(array_pad($provides,3,''),0,3);
        $topic = array_slice(array_pad($topic,3,''),0,3);
        $identity = array_slice(array_pad($identity,3,''),0,3);
        $interaction = array_slice(array_pad($interaction,3,''),0,3);

        //Upload Data
        $addinfo = 'UPDATE data SET sentence = "'.$sentence.'", description = "'.$description.'", providesa = "'.$provides[0].'", providesb = "'.$provides[1].'", providesc = "'.$provides[2].'", topica = "'.$topic[0].'", topicb = "'.$topic[1].'", topicc = "'.$topic[2].'", identitya = "'.$identity[0].'", identityb = "'.$identity[1].'", identityc = "'.$identity[2].'", interactiona = "'.$interaction[0].'", interactionb = "'.$interaction[1].'", interactionc = "'.$interaction[2].'" WHERE email = "'.$user.'";';
        $result = mysqli_query( $conn, $addinfo ); //needs securing

        
?>	

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
   </head>
    <body>
    <h3>3/3. Extra Info</h3>
        <form action="survey-finish.php" method="POST" id="form">
    <label >If your initiative has members, how many?<br/></label>
    <input type="text" name="members"/><br/>
    <label >Do you have any volunteer vacancies?:<br/></label>
    <select name="volunteervac">
        <option selected disabled>Choose</option>
        <option value="yes">Yes</option>
        <option value="no">No<option>
    </select><br/>
    <label >Do you have any job vacancies?:<br/></label>
    <select name="jobvac">
        <option selected disabled>Choose</option>
        <option value="yes">Yes</option>
        <option value="no">No<option>
    </select><br/>
    <label >In which year was your initiative founded?:<br/></label>
    <input type="text" name="foundingyear"><br/>
    <label >What is your initiative's legal form?:<br/></label>
    <input type="text" name="legal"><br/>
    <label >Does your initiative have a registering body (eg Companies House, Charity Commission)?<br/></label>
    <input type="text" name="registrar"><br/>
    <label >What is your registered number with that registrar?<br/></label>
    <input type="text" name="registerednum"><br/>
    <input type="submit" value="Submit"/><br/><br/>
    </form>
    

    </body>
</html>