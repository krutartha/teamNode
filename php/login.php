<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('db.php');
    $username = "";
    $email = "";
    $pasword = "";
    $firstName = "";
    $lastName = "";
    $errors = array();

        $username = $_GET['username'];
        $password = $_GET['pass'];

        if(empty($username)){
            array_push($errors, "Username cannot be blank");

        }

        else if(empty($password)){
            array_push($errors, "Password cannot be blank");
            
        }

        if(count($errors) == 0){
            $password = md5($password);
            $login_query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $result = mysqli_query($conn, $login_query);
            $row = mysqli_fetch_array($result);
            if(mysqli_num_rows($result) == 1){
                $_SESSION['id'] = $row['user_id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['username'] = $username;
                $_SESSION['bio'] = $row['bio'];
                $_SESSION['school_id'] = $row['school'];
                $id = $_SESSION['school_id'];
                $get_school = mysqli_query($conn, "SELECT * from schools WHERE school_id='$id'");
                $school_details=mysqli_fetch_assoc($get_school);
                $_SESSION['school_name']= $school_details['school_name'];
                $_SESSION['success'] = 'You are now logged in!';
                header("Location: ../../../html/index.html");
            }

            else{
                array_push($errors, "Invalid username/password");
            }
        }


?>