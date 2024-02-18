<?php
session_start();   // Starting Session

include("php/config.php");
// If the user tries to access this page without logging in, redirect them to the login page
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>

<body>
    <header class="dbHeader">
        <h2 class="logo"><a href="dashboard.php">Dashboard</a></h2>

        <section>
            <?php
            $id = $_SESSION['id']; // Get the ID of the logged in user from their session
            $query = mysqli_query($con, "SELECT * FROM users WHERE Id='$id'"); // Query the database for that user's information
            
            while ($result = mysqli_fetch_assoc($query)) {
                $res_Uname = $result['Username'];
                $res_Email = $result['Email'];
                $res_id = $result['Id'];
            }

            echo "<a class='edp' href='edit.php?Id=$res_id'>Edit Profile</a>";  // Create a link for users to edit their profile
            
            ?>


            <!-- <a class="edp" href="edit.php">Edit Profile</a> -->
            <a href="php/logout.php"><button class="btn">Logout</button></a>
        </section>
    </header>


    <div class="dbBody">
        <img class="pfp" src="pfp.jpg" alt="">

        <section>
            <h3>Welcome,
                <?php echo $res_Uname ?>
            </h3>
            <p class="">Email: <span>
                    <?php echo $res_Email ?>
                </span></p>
        </section>
    </div>

</body>

</html>