<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="card">
    <div class="layout">

        <div class="logo">
            <!-- log add part -->
        </div>

        <h6 class="title">SIGN WITH A WOLF CODE ACCOUNT</h6>

        <form autocomplete="off" action="includes/login.inc.php" method="post" autocomplete="random-string">
        <?php 
        if(isset($_GET['error'])) {
            if($_GET['error'] == "emptyfields") {  //"emptyfields" get from signup.inc.php file header output
                echo '<p class="signuperror">Fill in all fields!</p>';
            }
            else if($_GET['error'] == "sqlerror") {
                echo '<p class="signuperror">System error!</p>';
            }
            else if($_GET['error'] == "wrongpwd") {
                echo '<p class="signuperror">Invalid password!</p>';
            }
            else if($_GET['error'] == "nouser") {
                echo '<p class="signuperror">Invalid username</p>';
            }
        }
        else if(isset($_GET['signup'])) {
            if($_GET['signup']== "success") {
                echo '<p class="signupsuccess">Signup successful Log Now!</p>';
            }
        }
        else if(isset($_GET['newpwd'])) {
            if($_GET['newpwd']== "passwordupdated") {
                echo '<p class="signupsuccess">Password Updated Log Now!</p>';
            }
        }
         ?>

            <div class="email">
                <input type="email" name="mailuid" placeholder="Email Address" >
            </div>

            <div class="password">
                <input type="password" name="pwd" placeholder="Password" >
            </div>

            <div class="options">

                <div class="class-style">
                    <label for="#" class="check-box">
                        <input type="checkbox" id="#" name="#" value="Remember Me" class="checkbox" style="background: #a2a2a2;">
                        <p>Remember Me</p>
                    </label>
                </div>

                <div class="forgot-password">
                    <a href="forgot-password.php">Forgot Your Password</a>
                </div>

            </div>

            <div class="log-inmail">
                <button type="submit" name="login-submit">LOG IN NOW</button>
            </div>

            <div class="privacy">
                <a href="#">Privacy Policy</a>
            </div>

        </form>

        <div class="sign-upin-page">
            <span>Don't have a Wolf Code Account? <a href="sign-up.php">Sign Up</a></span>
        </div>
        
    </div>
</div>

    
</body>
</html>