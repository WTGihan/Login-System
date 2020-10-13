<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="card-sign-up">
    <div class="layout">

        <div class="logo">
            <!-- log add part -->
        </div>

        <h6 class="title">SIGN UP WITH A WOLF CODE ACCOUNT</h6>

        

        <form action="includes/signup.inc.php" method="post" autocomplete="off">

        <?php 
        if(isset($_GET['error'])) {
            if($_GET['error'] == "emptyfields") {  //"emptyfields" get from signup.inc.php file header output
                echo '<p class="signuperror">Fill in all fields!</p>';
            }
            else if($_GET['error'] == "invaliduidmail") {
                echo '<p class="signuperror">Invalid username and e-mail!</p>';
            }
            else if($_GET['error'] == "invaliduid") {
                echo '<p class="signuperror">Invalid username!</p>';
            }
            else if($_GET['error'] == "invalidmail") {
                echo '<p class="signuperror">Invalid e-mail!</p>';
            }
            else if($_GET['error'] == "passwordcheck") {
                echo '<p class="signuperror">Your passwords do not match!</p>';
            }
            else if($_GET['error'] == "usertaken") {
                echo '<p class="signuperror">Username is already taken!</p>';
            }
        }
        // else if(isset($_GET['signup'])) {
        //     if($_GET['signup'] == "success") {  //"emptyfields" get from signup.inc.php file header output
        //         echo '<p class="signuperror">Signup Success!</p>';
        //     }
         ?>

            <div class="username">
                <input type="text" name="uid" placeholder="Username">
            </div>

            <div class="email">
                <input type="email" name="mail" placeholder="Email Address">
            </div>

            <div class="password">
                <input type="password" name="pwd" placeholder="Password">
            </div>

            <div class="confirm-password">
                <input type="password" name="pwd-repeat" placeholder="Confirm Password">
            </div>

            <div class="options">

                <div class="class-style">
                    <label for="#" class="check-box">
                        <input type="checkbox" id="#" name="#" value="Remember Me" class="checkbox" style="background: #a2a2a2;">
                        <p>I have read and agree to the <a href="#">Term of Service</a></p>
                    </label>
                </div>

            </div>

            <div class="log-inmail">
                <button type="submit" name="signup-submit">SIGN UP</button>
            </div>

            <div class="privacy">
                <a href="#">Privacy Policy</a>
            </div>
            
        </form>

        <div class="sign-upin-page">
            <span>Have a Wolf Code Account? <a href="index.php">Sign In</a></span>
        </div>
        
    </div>
</div>
   
</body>
</html>