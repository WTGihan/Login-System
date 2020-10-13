<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="card">
    <div class="layout">

        <div class="logo">
            <!-- logo add part -->
        </div>

        <h6 class="title">FORGOT YOUR PASSWORD?</h6>
        
        <div class="paragraph">
            <p >
                Please fill in the email that you used to register. You will be sent an email with instructions on how to reset your password.
            </p>
        </div>

        <form action="includes/reset-request.inc.php" method="post" class="forgot-form">
            <?php    
            if(isset($_GET['error'])) {
                if($_GET['error'] == "error1") { 
                    echo '<p class="signuperror">System Error!</p>';
                }
                if($_GET['error'] == "error2") {  
                    echo '<p class="signuperror">Empty Field!</p>';
                }
            }
            ?>
            <div class="email">
                <input type="email" name="email" placeholder="Email Address">
            </div>

            <div class="log-inmail">
                <button type="submit" name="reset-request-submit">SEND MAIL</button>
            </div>
            
        </form>

        <div class="sign-upin-page">
            <span>Remeber Your Password? <a href="index.php">Sign In</a></span>
        </div>
        
    </div>
</div>
   
</body>
</html>