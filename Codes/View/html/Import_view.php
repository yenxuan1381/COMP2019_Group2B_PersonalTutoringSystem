<!DOCTYPE html>
<html lang="en">

    <head>
        <meta name="vieport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="image/icon.png" sizes="16x16">
        <title>NOTTSTUTOR</title>
        <link rel="stylesheet" type="text/css" href="./View/html/style.css">
        <link rel="stylesheet" type="text/css" href="./View/html/import_view.css">
    </head>
    <body>
        <aside>
            <div class="header">
                <div class="logo">
                    <img src="./image/logo1.png" alt="" >
                    <span class="title">NOTTSTUTOR</span>
                </div>
                <div class="hidden">
                    <img src="./image/icon.png" alt="">
                </div>
            </div>
            <!-- Navigation Bar -->
            <div class="menu">
                <?php 
                    if($_SESSION['category'] == "Student") {
                        require_once "sidebar_student.php";
                    }
                    else if($_SESSION['category'] == "Tutor"){
                        require_once "sidebar_tutor.php";
                    }else{
						require_once "sidebar_admin.php";
					} 
                ?>
            </div>
            <div class="logout">
                <a href="Loginpage.php">
                    <span class="title">Logout</span>
                    <ion-icon name="log-out"></ion-icon>
                </a>
            </div>
        </aside>
        <main>
            <div class="background">
                <div class="background-image"></div>
                <div class="title-container">
                    <span class="title">Import File</span>
                </div>
                <div class="content-container">
                    <!-- Form to retrieve csv file -->
					<form enctype="multipart/form-data" method="post" action="" id="importfile">
						<div class="drop-zone">
							<span class="drop-zone__prompt">Drop .csv file here or click to upload</span>
							<input type="file" name="file" id="file" class="drop-zone__input">
						</div>
						<input type="submit" name="submitfile">
						<input type="hidden" name="AdminID" value="<?php echo $userid; ?>" />
					</form>
                </div>
                
                <!-- Dropdown to change type of files (add student or add tutor) -->
                <div class="dropdown">
                    <ion-icon name="settings-outline"></ion-icon>
                    <div class="dropdown-content">
                        <ul>
                            <li>
                                <form method="POST">
                                    <input type="hidden" name="student">
                                    <button type="submit">
                                    <span class="channel">Add New Students</span>
                                </form>   
                            </li>
                            <li>
                                <form method="POST">
                                    <input type="hidden" name="tutor">
                                    <button type="submit">
                                    <span class="channel">Add New Tutors</span>
                                </form>   
                            </li>
                        </ul>
                    </div>
                </div>
				
            </div>
        </main>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<script src="import.js"></script>
    </body>
</html>



  