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

    //sign up code

    if(isset($_POST['signupUser'])){
        $username = mysqli_escape_string($conn, $_POST['username']);
        $email = mysqli_escape_string($conn, $_POST['email']);
        $pass1 = mysqli_escape_string($conn, $_POST['pass1']);
        $pass2 = mysqli_escape_string($conn, $_POST['pass2']);
        $school = mysqli_escape_string($conn, $_POST['school']);
        $dob = mysqli_escape_string($conn, $_POST['dob']);
        $firstName = mysqli_escape_string($conn, $_POST['firstName']);
        $lastName = mysqli_escape_string($conn, $_POST['lastName']);

        if(empty($username)){
            array_push($errors, "Username cannot be blank");

        }

        else if(empty($email)){
            array_push($errors, "Email cannot be blank");

        }

        else if(empty($pass1) || empty($pass2)){
            array_push($errors, "Password cannot be blank");

        }


        else if($pass1 != $pass2){
            array_push($errors, "The passwords do not match");

        }

        $check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'LIMIT 1";
        $result = mysqli_query($conn, $check_query); 
        $user = mysqli_fetch_assoc($result);
        $school_query = mysqli_query($conn, "SELECT * FROM schools WHERE school_name='$school'");
        $school_array = mysqli_fetch_assoc($school_query);
        $school_id = $school_array['school_id'];
       
        

        if($user){
            if($user['username'] === $username){
                array_push($errors, "Username already exists");
            }
            if($user['email'] === $email){
                array_push($errors, "Email already exists");
            }
        }

        if(count($errors) == 0){
            $pass1 = md5($pass1);
            $signup_query = "INSERT INTO users(username, password, bio, firstName, lastName, email, dob, school) VALUES ('$username', '$pass1', 'I love coding..', '$firstName', '$lastName', '$email', '$dob', '$school_id')";
            mysqli_query($conn, $signup_query);
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['firstName'] = $firstName;
            $_SESSION['success'] = "You are now a user";
            $_SESSION['school_id'] = $school_id;
            $_SESSION['school_name'] = $school;
            header("Location: ../../html/login.html");
        }

    }


    //login
   

    if(isset($_POST['loginUser'])){
        $username = mysqli_escape_string($conn, $_POST['username']);
        $password = mysqli_escape_string($conn, $_POST['pass']);

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
                header("Location: ../../html/index.html");
            }

            else{
                array_push($errors, "Invalid username/password");
                header("Location: ../new/html/login.html");
            }
        }
    }
?>