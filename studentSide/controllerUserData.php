<?php 
    session_start();
    require "C:\\\\xampp\htdocs\Capstone\bookbuddy\connection.php";

    $email = "";
    $name = "";
    $studentID = "";
    $classCode= "";
    $errors = array();

    //if user signup button
    if(isset($_POST['signup'])){
        $classCode = mysqli_real_escape_string($con, $_POST['classCode']);
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $studentID = mysqli_real_escape_string($con, $_POST['studentID']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }
        $email_check = "SELECT * FROM studentTable WHERE email = '$email'";
        $res = mysqli_query($con, $email_check);
        if(mysqli_num_rows($res) > 0){
            $errors['email'] = "The email you have entered already exists!";
        }
        $classCode_check = "SELECT * FROM teacherTable WHERE classCode != '$classCode'";
        $res = mysqli_query($con, $classCode_check);
        if(mysqli_num_rows($res) > 0){
            $errors['classCode'] = "The class code you entered does not exist!";
        }
        if(count($errors) === 0){
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $code = rand(999999, 111111);
            $status = "notverified";
            $insert_data = "INSERT INTO studentTable (classCode, name, studentID, email, password, code, status)
                            values('$classCode', '$name', '$studentID', '$email', '$encpass', '$code', '$status')";
            $data_check = mysqli_query($con, $insert_data);
            if($data_check){
                $subject = "Email Verification Code";
                $message = "Your verification code is $code";
                $sender = "From: caroline.seegmiller@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a verification code to your parent's email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    header('location: user-otp.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Failed while inserting data into database!";
            }
        }

    }

    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM studentTable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE studentTable SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: home.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click login button
    if(isset($_POST['login'])){
        $studentID = mysqli_real_escape_string($con, $_POST['studentID']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $check_studentID = "SELECT * FROM studentTable WHERE studentID = '$studentID'";
        $res = mysqli_query($con, $check_studentID);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['studentID'] = $studentID;
                $status = $fetch['status'];
                if($status == 'verified'){
                  $_SESSION['studentID'] = $studentID;
                  $_SESSION['password'] = $password;
                    header('location: home.php');
                }else{
                    $info = "It's look like you haven't still verify your email - $email";
                    $_SESSION['info'] = $info;
                    header('location: user-otp.php');
                }
            }else{
                $errors['studentID'] = "Incorrect password!";
            }
        }else{
            $errors['studentID'] = "It's look like you don't have a buddy yet! Click on the bottom link to sign up.";
        }
    }

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM studentTable WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE studentTable SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: caroline.seegmiller@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent an email to your parents to reset your password - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM studentTable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered an incorrect code!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Passwords do not match!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE studentTable SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Your password has changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: login-user.php');
    }
    
    // if startTime button click
    if(isset($_POST['stopTime'])){
        $_SESSION['info'] = "";
        $studentID = $_SESSION['studentID']; //getting this studentID using session
        $name_getter = "SELECT name FROM studentTable WHERE studentID = $studentID"; // get name from student table
        $holder = mysqli_query($con, $name_getter); 
        if(mysqli_num_rows($holder) > 0){
            $fetch_data = mysqli_fetch_assoc($holder);
            $name = $fetch_data['name'];
        }
        $dateSubmit = date('Y-m-d'); //get date from user
        
        $insert_read_data = "INSERT INTO readingTable (studentID, name, dateSubmit, startPage, endPage, totalPage, minutes)
                VALUES ('$studentID', '$name', '$dateSubmit', '$startPage', '$endPage', ' $totalPage', '$minutes')";
            $run_query = mysqli_query($con, $insert_read_data);
    }

?>