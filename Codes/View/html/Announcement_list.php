<!DOCTYPE html>
<html lang="en">

    <head>
        <meta name="vieport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="image/icon.png" sizes="16x16">
        <title>NOTTSTUTOR</title>
        <link rel="stylesheet" type="text/css" href="./View/html/style.css">
        <link rel="stylesheet" type="text/css" href="./View/html/announcement.css">
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
                    <span class="title">Announcement</span>
                </div>
                <div class="content-container">
                    <ul>
                        <!-- Display all announcement list -->
                        <?php if($result->num_rows > 0){while($row = $result->fetch_assoc()) { ?>
                        <li>
                            <div class="Announcement-info">
                                <a href="AnnouncementView.php?announcementid=<?php echo $row["announcement_id"] ?>">
                                    <span class="detail">Title: <?php echo $row["title"] ?></span>
                                    <span class="from">From: <?php echo $row["tutor_name"] ?></span>
                                </a>
                            </div>
                        <!-- Display edit and delete buttons if the category is tutor -->
                        <?php if($_SESSION['category']=="Tutor"){ ?>
                            <div class="edit-announcement">
                                <a href="announcementedit.php?id=<?php echo $row["announcement_id"]?>">
                                    <ion-icon name="create"></ion-icon>
                                </a>
                            </div>
                            <div class="delete-announcement">
                                <form method="post" onsubmit="return confirm('Are you sure you want to delete this announcement?');">
									<input type="hidden" name="delete">
									<input type="hidden" name="id" value="<?php echo $row["announcement_id"]?>">
									<button type="submit" >
                                        <ion-icon name="trash"></ion-icon>
                                    </input>
								</form> 
                                    
                                
                            </div>
                        <?php } ?>
                        </li> 
                        <?php } } ?>                
                    </ul>
                </div>
                <!-- Display add button if the category is tutor -->
                <?php if($_SESSION['category']=="Tutor"){ ?>
                <div class="function-icon">
                    <a href="AddAnnouncement.php">
                        <ion-icon name="add-circle"></ion-icon>
                    </a>
                </div>
                <?php } ?>
            </div>
        </main>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>