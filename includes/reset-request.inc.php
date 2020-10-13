<?php 

if(isset($_POST["reset-request-submit"])) {

    $selector = bin2hex(random_bytes(8)); //binary to hexa decimal value
    $token = random_bytes(32);

    //care about that
    $url = "http://localhost/learns/wolfcodelogin/reset-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 1800;  //date("U") mean Todays data in seconds since 1970

    require 'dbh.inc.php';

    $userEmail = $_POST["email"];

    if(!empty($userEmail)) {

        $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../forgot-password.php?error=error1");
            //echo "There was an error!";
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $userEmail);
            mysqli_stmt_execute($stmt);
        }

        //Random Generate Token and Selector Put into the Databases
        $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../forgot-password.php?error=error1");
            //echo "There was an error!";
            exit();
        }
        else {
            $hashedToken = password_hash($token, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
            mysqli_stmt_execute($stmt);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        $to = $userEmail;

        $subject = 'Reset your password for mmtuts';

        $message = '<p>We received a password reset requests. The link to reset your password.. make this request, you can ignore this mail</p>';
        $message .=  '<p>Here is your password reset link: </br>';
        $message .=  '<a href="' . $url .'">' . $url . '</a></p>';
        
        $headers = "From: tharindu <wtgihan@gmail.com>\r\n";
        $headers = "Reply-To: wtgihan@gmail.com\r\n";
        $headers = "Content-type: text/html\r\n";

        mail($to, $subject, $message, $headers);

        header("Location: ../send-mail.php?reset=success");
        exit();
    }
    else {
        header("Location: ../forgot-password.php?error=error2");
        //echo "There was an error!";
        exit();
    }

}
else {
    header("Location: ../index.php");
}
