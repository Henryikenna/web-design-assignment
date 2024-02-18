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
    <title>Edit Profile</title>
</head>

<body>
    <header class="dbHeader">
        <h2 class="logo"><a href="dashboard.php">Dashboard</a></h2>

        <section>
            <a class="edp" href="#">Edit Profile</a>
            <a href="php/logout.php"><button class="btn">Logout</button></a>
        </section>
    </header>


    <div class="container">
        <div class="box form-box">

            <?php
            if (isset($_POST['submit'])) {
                $username = $_POST['username'];
                $email = $_POST['email'];

                $id = $_SESSION['id'];

                $edit_query = mysqli_query($con, "UPDATE users SET Username='$username', Email='$email' WHERE Id=$id") or die("Error Occured");

                if ($edit_query) {
                    echo "<div class = 'message'>
               <p>Profile Updated Sucessfully!.</p>
               </div>";

                    echo "<a href ='dashboard.php'><button class='btn'>Go to Dashboard</button></a>";
                }
            } else{

                $id = $_SESSION['id'];
                $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");

                while ($result = mysqli_fetch_assoc($query)) {
                    $res_Uname = $result['Username'];
                    $res_Email = $result['Email'];
                }

            ?>

            <header>Edit Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" value="<?php echo $res_Uname; ?>" autocomplete="off" id="username" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?php echo $res_Email; ?>" autocomplete="off" id="email" required>
                </div>

                <div class="field">
                    <input class="btn" type="submit" name="submit" value="Update" required>
                </div>

            </form>
        </div>
        <?php } ?>
    </div>
</body>

</html>