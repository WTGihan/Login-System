<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="card">
    <div class="layout">

        <div class="logo">
            <!-- log add part -->
        </div>

        <h6 class="title">RESET YOUR PASSWORD</h6>
        
        <form action="includes/reset-password.inc.php" method="post" class="reset-form">
            <?php    
            if(isset($_GET['newpwd'])) {
                if($_GET['newpwd'] == "empty") {
                    echo '<p class="signuperror">Fill in all fields!</p>';
                }
                else if($_GET['newpwd'] == "pwdnotsame") {
                    echo '<p class="signuperror">Password are NOT SAME!</p>';
                }
                else if($_GET['newpwd'] == "error") {
                    echo '<p class="signuperror">System Error!</p>';
                }
                else if($_GET['newpwd'] == "error1") {
                    echo '<p class="signuperror">Re-Submit your reset request</p>';
                }
            }
            ?>
    
            <?php 
                $selector = $_GET["selector"];
                $validator = $_GET["validator"];

                if(empty($selector) || empty($validator)) {
                    echo "Could not validate your request";
                }
                else {
                    if(ctype_xdigit($selector) !== false && ctype_xdigit($selector) !== false) {
                        ?>

                        <!-- <form action="includes/reset-password.inc.php" method="post"> -->
                           
                            <input type="hidden" name="selector" value="<?php echo $selector?>">
                            <input type="hidden" name="validator" value="<?php echo $validator?>">

                            <div class="password">
                                <input type="password" name="pwd" placeholder="New Password">
                            </div>

                            <div class="password">
                                <input type="password" name="pwd-repeat" placeholder="Confirm Password">
                            </div>

                            <div class="log-inmail">
                                <button type="submit" name="reset-password-submit">RESET PASSWORD</button>
                            </div>


                        <?php

                                
                            }
                        }

                         ?>
        </form>



            

    </div>
</div>

    
</body>
</html>