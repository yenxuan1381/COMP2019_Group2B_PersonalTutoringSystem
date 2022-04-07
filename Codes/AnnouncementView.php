<?php
	session_start();

	include_once('Connection.php');

	// If haven't login, then change to login page
	if((!(isset($_SESSION['userid']))) or (($_SESSION['category'] != "Tutor") and ($_SESSION['category'] != "Student")))
	{
		header("Location:Loginpage.php");
	}

	$userid = $_SESSION['userid'];
	
	if(isset($_POST['id'])){
		$_SESSION['announcementid'] = $_POST['id'];
	}

	
	$announcementid = $_GET['announcementid'];
	
	

	
    $sql = "SELECT * FROM announcement WHERE announcement_id = '$announcementid';";
	$result = $conn->query($sql);	
	$sql1 = "SELECT * FROM comment WHERE announcement_id = '$announcementid';";	
	$result1 = $conn->query($sql1);	
	if($_SESSION['category']=="Student"){
		$sql2 = "SELECT name FROM tutors WHERE `Lect ID` = (SELECT `Tutor Id` FROM students WHERE `Student Id` ='$userid')";
		$sql3 = "SELECT `Full Name` FROM students WHERE `Student Id` = '$userid'";
		$result3 = $conn->query($sql3);	
		while($rows=$result3->fetch_assoc())
		{
			$studentname = $rows['Full Name'];
		}
	}
	elseif($_SESSION['category']=="Tutor"){
		$sql2 = "SELECT name FROM tutors WHERE `Lect ID` = $userid";
	}
	$result2 = $conn->query($sql2);	
	while($rows=$result2->fetch_assoc())
	{
		$tutorname = $rows['name'];
	}	
	
	if(isset($_POST['text'])){
		$comment = $_POST['text'];
		if($_SESSION['category']=="Tutor"){
			$sql = "INSERT INTO comment (user_name,announcement_id,content) VALUES ('$tutorname','$announcementid','$comment')";
		}
		elseif($_SESSION['category']=="Student"){
			$sql = "INSERT INTO comment (user_name,announcement_id,content) VALUES ('$studentname','$announcementid','$comment')";
		}
		
				
		if(mysqli_query($conn, $sql)){
			header("Location:Announcementview.php?announcementid=$announcementid");
		} 
		else {
    			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
	
	<style>
		button.primaryContained {
			position: absolute;
			width: 100%;
			top: calc(140px + 75%);
			background: #016ba8;
			color: #fff;
			padding: 10px 10px;
			border: none;
			margin-top: 0px;
			cursor: pointer;
			text-transform: uppercase;
			letter-spacing: 4px;
			box-shadow: 0px 2px 6px 0px rgba(0, 0, 0, 0.25);
			transition: 1s all;
			font-size: 10px;
			border-radius: 15px;
		}
		button.primaryContained:hover {
			background: #9201A8;
		}
		.container1 textarea {
			position: absolute;
			top: calc(40px + 75%);
			width: 100%;
			border: none;
			background: #E8E8E8;
			padding: 5px 10px;
			height: 15%;
			border-radius: 20px;
			border-bottom: 2px solid #016BA8;
			transition: all 0.5s;
			margin-top: 15px;
		}		
	</style>
	<head>
        <meta name="vieport" content="width=device-width, initial-scale=1.0">
        <title>Nottingham Tutor 2.0</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="Announcement_view.css">
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
                        <a href="profile.html">
                            <ion-icon name="person"></ion-icon>
                            <span class="title">Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="appointment.html">
                            <ion-icon name="calendar"></ion-icon>
                            <span class="title">Appointment</span>
                        </a>
                    </li>
                    <li>
                        <a href="Announcement.php">
                            <ion-icon name="mail"></ion-icon>
                            <span class="title">Annoucement</span>
                        </a>
                    </li>
                    <li>
                        <a href="message.html">
                            <ion-icon name="chatbubble-ellipses"></ion-icon>
                            <span class="title">Message</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="logout">
                <a href="loginpage.php">
                    <span class="title">Logout</span>
                    <ion-icon name="log-out"></ion-icon>
                </a>
            </div>
        </aside>
		<main>
		<?php 
            while($rows=$result->fetch_assoc())
            {   
		?>
			<div class="background">
					<div class="background-image"></div>
					<div class="title-container">
						<span class="title"><?php echo $rows['title']?></span>
					</div>
					<div class="Annoucement-container">
						<div class="from-container">
							<span class="from">From:</span>
							<span class="tutor"><?php echo $rows['tutor_name']?></span>
						</div>
						<div class="Annoucement-info">
							<h3><pre><?php echo $rows['content']?></pre></h3>
						</div>
					</div>
					<div class="Comment-container">
						<div class="comment">
							<p>
							<?php
								while($rows=$result1->fetch_assoc())
								{   
									echo "<span style='color:blue;font-weight:bold;font-size:25px'>",$rows['user_name'],"</span>: ",$rows['content'],"<br><br>";	
								} 
							?> 
							</p>
						</div>
							<div class="container1">
								<form  method="POST" onsubmit="return confirm('Are you sure you want to comment?');">	
								<textarea type="text" id="text_id" name="text" class="input" placeholder="Write a comment"></textarea>							
								<button  class='primaryContained float-right' type="submit">Add Comment</button>
								</form>
							</div>
						</div>
					</div>
					<div class="back-button">
						<a href="announcement.php">
							<ion-icon name="arrow-back"></ion-icon>
						</a>
					</div>
			</div>
			<?php } ?>
		</main>
		<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	</body>

    
    
    </html>

