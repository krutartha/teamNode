<?php 
include('./server.php') ;
include('.db.php') ;
    $username = $_GET['username'];
    $email = $_GET['email'];
    $bio = $_GET['bio'];
    $user = $_SESSION['id'];
    if($username != ''){
    $updtateInfo = mysqli_query($conn, "UPDATE users SET username='$username', email='$email', bio='$bio' WHERE user_id='$user'");
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['bio'] = $bio;



}
    
?>