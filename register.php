<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <div class="container">
        <div class="box form-box">

        <?php 
        
        include("php/config.php");
        
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            
            $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email = '$email'");

            // check if the email is already in the database
            if (mysqli_num_rows($verify_query) != 0) {
               echo "<div class = 'message'>
               <p>This email is already in use. Try another one.</p>
               </div>";
               
               echo "<a href ='javascript:self.history.back();'><button class='btn'>Go Back</button></a>";
               
               
            } else{
                mysqli_query($con, "INSERT INTO users(Username, Email, Password) VALUES('$username', '$email','$password')") or die("Error occured");

                echo "<div class = 'message'>
               <p>Registration Successful!.</p>
               </div>";
               
               echo "<a href ='index.php'><button class='btn'>Login Now</button></a>";
            }
        } else{

    
        
        ?>


            <header>Register</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="username">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="field">
                    <input class="btn" type="submit" name="submit" value="Register" required>
                </div>

                <div class="links">
                    Already have an account? <a href="index.php">Login</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>

</html>