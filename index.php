<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="box form-box">

            <?php
            include("php/config.php");

            
            if (isset($_POST['submit'])) {
                $email = mysqli_real_escape_string($con, $_POST['email']);
                $password = mysqli_real_escape_string($con, $_POST['password']);

                $result = mysqli_query($con,"SELECT * FROM users WHERE Email='$email' AND Password='$password'") or die("Error");
                $row = mysqli_fetch_assoc($result);

                // Checking if the email and password are correct 
                if (is_array($row) && !empty($row)) {
                    $_SESSION['valid'] = $row['Email'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['id'] = $row['Id'];
                } else {
                    echo "<div class = 'message'>
               <p>Wrong Username or Password.</p>
               </div>";

                    echo "<a href ='index.php'><button class='btn'>Go Back</button></a>";
                }
                // If everything is valid, go to dashboard
                if(isset($_SESSION['valid'])){
                    header("Location: dashboard.php");
                }

            } else{
            ?>


            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" autocomplete="off" id="email" required>
                </div>
                <div class="field input">
                    <label for="username">Password</label>
                    <input type="password" name="password" autocomplete="off" id="password" required>
                </div>
                <div class="field">
                    <input class="btn" type="submit" name="submit" value="Login" required>
                </div>

                <div class="links">
                    Don't have an account? <a href="register.php">Register</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>

</html>