<?php

if(isset($_POST["reset-password-submit"])) {

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwd-repeat"];
    
    //Form Validations
    if(empty($password) || empty($passwordRepeat)) {
        header("Location: ../reset-password.php?newpwd=empty&selector=".$selector."&validator=".$validator);
        exit();
        
    }
    else if($password != $passwordRepeat) {
        header("Location: ../reset-password.php?newpwd=pwdnotsame&selector=".$selector."&validator=".$validator);
        exit();
    }

    $currentDate = date("U");

    require 'dbh.inc.php';

    //Compare Selector given and Database Selector
    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../reset-password.php?newpwd=error=".$selector."&validator=".$validator);
        // header("Location: ../reset-password.php?newpwd=error");
        // echo "There was an error1!";
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "sd", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if(!$row = mysqli_fetch_assoc($result)) {       //assoc =associative array
            header("Location: ../reset-password.php?newpwd=error1&selector=".$selector."&validator=".$validator);
            
            // echo "You need to re-submit your reset request.";
            exit();
        }
        else {

            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            if($tokenCheck === false){
                header("Location: ../reset-password.php?newpwd=error1&selector=".$selector."&validator=".$validator);
                
                // echo "You need to re-submit your reset request.";
                exit();
            }
            else if($tokenCheck === true) {

                $tokenEmail = $row['pwdResetEmail'];

                $sql = "SELECT * FROM users WHERE emailUsers=?;";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../reset-password.php?newpwd=error&selector=".$selector."&validator=".$validator);
                    
                    // echo "There was an error3!";
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);

                    $result = mysqli_stmt_get_result($stmt);
                    if(!$row = mysqli_fetch_assoc($result)) {       //assoc =associative array
                        header("Location: ../reset-password.php?newpwd=error&selector=".$selector."&validator=".$validator);
                        
                        //echo "There was an error3";
                        exit();
                    }
                    else {

                        $sql = "UPDATE users SET pwdUsers=? WHERE emailUsers=?";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../reset-password.php?newpwd=error&selector=".$selector."&validator=".$validator);
                            
                            // echo "There was an error4!";
                            exit();
                        }
                        else {
                            $newPwdHash = password_hash($password, PASSWORD_DEFAULT);

                            mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            //Delete the token
                            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)) {
                                header("Location: ../reset-password.php?newpwd=error&selector=".$selector."&validator=".$validator);
                                // echo "There was an error5!";
                                exit();
                            }
                            else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../index.php?newpwd=passwordupdated");
                            }
                        }
                    }

                }
            }    
        }
    }




}
else {
    header("Location: ../index.php");
}



