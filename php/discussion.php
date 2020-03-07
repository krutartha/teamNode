<?php  

 include('./server.php');
 include('./db.php');
 if(isset($_GET['postmessage'])){
    $text = htmlspecialchars($_GET['postmessage'], ENT_QUOTES);
    $user = $_SESSION['id'];
    if( $text!=null || $text=""){
        $pusmessage = mysqli_query($conn, "INSERT INTO messages(message_body, sender) VALUES('$text', '$user')");
    }
 }
 $discussions = array();
 $by = array();
 $reversedMessage = array();
 $reversedSender = array();
    $result = mysqli_query($conn, "SELECT * FROM messages ");

   
    
    while($output = mysqli_fetch_assoc($result)):?>
    <?php
        $id = $output['sender'];
        $getname = mysqli_query($conn, "SELECT * from users WHERE user_id='$id'");
        $fetched = mysqli_fetch_assoc($getname);
        $discussion = $output['message_body'];
        $sender = $fetched['username'];
        array_push($discussions, $discussion );
        array_push($by, $sender);
        $reversedMessage = array_reverse($discussions);
        $reversedSender = array_reverse($by);
        if($fetched['username'] == $_SESSION['username'] ):
    ?>
        <ion-card>
        <ion-item href="#" class="ion-activated">
            <ion-label class="ion-text-end"><?php echo $fetched['username']?></ion-label>
        </ion-item>

        <ion-card-content>
            <p class="ion-text-end" slot="start"><?php echo $output['message_body']?></p>
        </ion-card-content>
    </ion-card>
        <?php endif?>
        <?php if($fetched['username'] !== $_SESSION['username'] ): ?>
            <ion-card>
        <ion-item href="#">
            <ion-label><?php echo $fetched['username']?></ion-label>
        </ion-item>
        <ion-card-content>
            <p slot="start"><?php echo $output['message_body']?></p>
        </ion-card-content>
    </ion-card>

        <? endif ?>


    
    <?php endwhile ?>
    <?php if(mysqli_num_rows($result) == 0):?>
    <ion-text class="ion-text-center">Nothing to see here yet...</ion-text>
    <?php endif ?>

    

    

