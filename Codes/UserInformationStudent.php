<?php

	session_start();

	include_once('Connection.php'); //to connect the page to the database

	// If haven't login, then change to login page
	if((!(isset($_SESSION['userid']))) or ($_SESSION['category'] != "Student"))
	{
		header("Location:Loginpage.php");
	}

	$userid = $_GET['studentID']?? "";

	// if(!empty($_POST['submit'])){
	//   $userid = $_POST['studentID'];
	//   $_SESSION['studentID'] = $userid;
	// }

	$getStudentID = $userid;

	$firstNameQuery = 'SELECT students.`First Name` FROM `students` WHERE `Student Id` = '.$userid.'';
	$getStudentFirstName = mysqli_query($conn, $firstNameQuery) or die("Error fetching student's first name.");
	$firstName = mysqli_fetch_array($getStudentFirstName,MYSQLI_ASSOC);

	$lastNameQuery = 'SELECT students.`Last Name` FROM `students` WHERE `Student Id` = '.$userid.'';
	$getStudentLastName = mysqli_query($conn, $lastNameQuery) or die("Error fetching student's last name.");
	$lastName = mysqli_fetch_array($getStudentLastName,MYSQLI_ASSOC);

    $genderQuery = 'SELECT students.`Gender` FROM `students` WHERE `Student Id` = '.$userid.'';
	$getStudentGender = mysqli_query($conn, $genderQuery) or die("Error fetching student's gender.");
	$gender = mysqli_fetch_array($getStudentGender,MYSQLI_ASSOC);	

	$nationalityQuery = 'SELECT students.`Nationality` FROM `students` WHERE `Student Id` = '.$userid.'';
	$getStudentNationality = mysqli_query($conn, $nationalityQuery) or die("Error fetching student's last name.");
	$nationality = mysqli_fetch_array($getStudentNationality,MYSQLI_ASSOC);

	$emailQuery = 'SELECT students.`Email Address` FROM `students` WHERE `Student Id` = '.$userid.'';
	$getStudentEmail = mysqli_query($conn, $emailQuery) or die("Error fetching student's email.");
	$email = mysqli_fetch_array($getStudentEmail,MYSQLI_ASSOC);

	//Academic Information

	$academicPlanCodeQuery = 'SELECT students.`Academic Plan Code` FROM `students` WHERE `Student Id` = '.$userid.'';
	$getStudentAcademicPlanCode = mysqli_query($conn, $academicPlanCodeQuery) or die("Error fetching student's academic plan code.");
	$academicPlanCode = mysqli_fetch_array($getStudentAcademicPlanCode,MYSQLI_ASSOC);

	$academicPlanQuery = 'SELECT `academic plan codes`.`Academic Plan` FROM `academic plan codes` JOIN students ON students.`Academic Plan Code` = `academic plan codes`.`Code` WHERE students.`Student Id` ='.$userid.'';
	$getStudentAcademicPlan = mysqli_query($conn, $academicPlanQuery) or die("Error fetching student's academic plan.");
	$academicPlan = mysqli_fetch_array($getStudentAcademicPlan,MYSQLI_ASSOC);

	$currentYearQuery = 'SELECT students.`Current Year` FROM `students` WHERE `Student Id` = '.$userid.'';
	$getStudentCurrentYear = mysqli_query($conn, $currentYearQuery) or die("Error fetching student's currnt year.");
	$currentYear = mysqli_fetch_array($getStudentCurrentYear,MYSQLI_ASSOC);

	$levelQuery = 'SELECT students.`Level` FROM `students` WHERE `Student Id` = '.$userid.'';
	$getStudentLevel = mysqli_query($conn, $levelQuery) or die("Error fetching level.");
	$level = mysqli_fetch_array($getStudentLevel,MYSQLI_ASSOC);

	$registrationDateQuery = 'SELECT students.`Registration Date` FROM `students` WHERE `Student Id` = '.$userid.'';
	$getStudentRegistrationDate = mysqli_query($conn, $registrationDateQuery) or die("Error fetching student's registration date.");
	$registrationDate = mysqli_fetch_array($getStudentRegistrationDate,MYSQLI_ASSOC);


    if(isset($_POST['Personal_Goal'])){
        $personalGoals = $_POST['Personal_Goal'];
        $editPersonalGoalsQuery = "UPDATE students SET `Personal Goals` = '$personalGoals' WHERE `Student Id` = '$userid'";
        if(mysqli_query($conn, $editPersonalGoalsQuery)){
    		header("Location: UserInformationStudent.php?studentID=".$userid);
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }

    $personalGoalsQuery = 'SELECT students.`Personal Goals` FROM `students` WHERE `Student Id` = '.$userid.'';
	$getPersonalGoals = mysqli_query($conn, $personalGoalsQuery) or die("Error fetching student's personal goals.");
	$personalGoals = mysqli_fetch_array($getPersonalGoals,MYSQLI_ASSOC);



?>

<!-- start of the HTML script for the student view page  -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="vieport" content="width=device-width, initial-scale=1.0">
        <title>Nottingham Tutor 2.0</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="profile.css">
    </head>
    <body>
	<aside>
            <div class="header">
                <div class="logo">
                    <img src="./image/logo1.png" alt="" >
                    <span class="title">Nottingham Tutor 2.0</span>
                </div>
                <div class="hidden">
                    <img src="./image/icon.png" alt="">
                </div>
            </div>
            <div class="menu">
                <ul>
                    <li>
                        <a href="StudentView.php">
                        <ion-icon name="home"></ion-icon>
                            <span class="title">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="UserInformationStudent.php?studentID=<?php echo $userid ?>">
                            <ion-icon name="person"></ion-icon>
                            <span class="title">Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="Appointmentview.php">
                            <ion-icon name="calendar"></ion-icon>
                            <span class="title">Appointment</span>
                        </a>
                    </li>
                    <li>
                        <a href="Announcement.php?studentID=<?php echo $userid ?>">
                            <ion-icon name="mail"></ion-icon>
                            <span class="title">Announcement</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <ion-icon name="chatbubble-ellipses"></ion-icon>
                            <span class="title">Message</span>
                        </a>
                    </li>
					<li>
                        <a href="ContactTuteepage.php">
							<ion-icon name="help-circle"></ion-icon>
                            <span class="title">Contact Us</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="logout">
                <a href="Loginpage.php">
                    <span class="title">Logout</span>
                    <ion-icon name="log-out"></ion-icon>
                </a>
            </div>
        </aside>
        <main>
            <div class="upper_profile">
                <div class="profile_detail">
                    <div class="photo">
                        <img src="./image/profile.jpeg" alt="">
                    </div>
                    <div class="profile_name">
                        <h3>My Profile:</h3>
                        <h1><?php echo $firstName['First Name']?></h1>
                        <h4><?php echo $lastName['Last Name']?></h4>
                    </div>
                    <span class="role">Student</span>
                </div>
            </div>
            <div class="edit_goal">
                <button class="edit" onclick="pop()"><ion-icon name="create"></ion-icon></button>
                <div id="pop-out">
                    <form method="post">
                        <label for="Personal_Goal">Edit Personal Goal</label><br>
                        <textarea name="Personal_Goal" placeholder="Your Personal Goal.."></textarea><br>
                        <input type="submit" value="Confirm">
                    </form>
                    <button class="edit" onclick="remove()"><ion-icon name="close"></ion-icon></button>
                </div>
            </div>
            <div class="lower_profile">
                <div class="info">
                    <p>Personal Information</p>
					<strong>Student ID: <br></strong> <?php echo $getStudentID ?> </br>
					<strong>First Name: <br></strong> <?php echo $firstName['First Name'] ?> </br>
					<strong>Last Name: <br></strong> <?php echo $lastName['Last Name'] ?> </br>
					<strong>Nationality: <br></strong> <?php echo $nationality['Nationality'] ?> </br>
					<strong>Email: <br></strong> <?php echo $email['Email Address'] ?> </br>
                </div>
                <div class="academic">
                    <p>Academic Information</p>
					<strong>Academic Plan Code: <br></strong> <?php echo $academicPlanCode['Academic Plan Code'] ?> </br>
					<strong>Academic Plan: <br></strong> <?php echo $academicPlan['Academic Plan'] ?> </br>
					<strong>Level: <br></strong> <?php echo $level['Level'] ?> </br>
					<strong>Current Year: <br></strong> <?php echo $currentYear['Current Year'] ?> </br>
					<strong>Registration Date: <br></strong> <?php echo $registrationDate['Registration Date'] ?> </br>
                </div>
                <div class="personal-goal">
                    <p>Personal Goal</p>
                    <?php echo $personalGoals['Personal Goals'] ?>
                </div>
            </div>
        </main>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        function pop() {
            document.getElementById("pop-out").style.visibility = "visible";
        }
        function remove() {
            document.getElementById("pop-out").style.visibility = "hidden";
        }
    </script>
    </body>
</html>
<!-- End of HTML script -->
