<?php
include('server.php');
if(!empty($_GET['q'])){
    include('db.php');
    $q = $_GET['q'];
    $school_check = $_SESSION['school_id'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username LIKE '%$q%' AND school='$school_check'");
    while($output = mysqli_fetch_assoc($result)){

        if($output['username']==$_SESSION['username']){
            echo '
        <ion-text class="ion-text-center">
          <h4>No Matching Results</h4>
        </ion-text>
        ';

        }
        else{
            echo '<ion-card>
        <ion-card-header>
            <ion-card-subtitle>'.$_SESSION['school_name'].'</ion-card-subtitle>
            <ion-card-title>'.$output['username'].'</ion-card-title>

        </ion-card-header>
        <ion-card-content>
        <ion-button fill="outline" slot="end">Add</ion-button>
            <ion-button fill="outline" slot="end">View</ion-button>
        </ion-card-content>
    </ion-card>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.esm.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.js"></script>'; 
        }
    }
    if(mysqli_num_rows($result) == 0){
        echo '
        <ion-text class="ion-text-center">
          <h4>No Matching Results</h4>
        </ion-text>
        ';
    }
    
}

?>
