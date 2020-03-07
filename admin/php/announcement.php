<?php 
include('./db.php');
include('./server.php');
if(!empty($_GET['announcement'])){
    $text = $_GET['announcement'];
    $user = $_SESSION['id'];
    if($text != ''){
    $pusmessage = mysqli_query($conn, "INSERT INTO announcements(announcement_body, sender) VALUES('$text', '$user')");

}
    

}
    
?>