<?php

include('db.php');

$feeds = array();
$dates = array();
$sender = array();
$announcement = "";

$feedquery = "SELECT announcement_body, timestamp FROM announcements";
$getfeed = mysqli_query($conn, $feedquery);

if(mysqli_num_rows($getfeed) > 0){
    while($row = mysqli_fetch_assoc($getfeed)){
        $announcement = $row['announcement_body'];
        $time = date('jS M, h:i a', strtotime($row['timestamp']));
        array_push($feeds, $announcement);
        array_push($dates, $time);
    }

    

}

$reverse_feeds = array_reverse($feeds);
$reverse_dates = array_reverse($dates);

?>

<?php  if (count($reverse_feeds) > 0 && count($reverse_dates) > 0) : ?>
  <ion-scroll>
  <div class="feed" id='fesh'>
	  <?php for($x=0; $x < count($reverse_feeds); $x++): ?>
        <ion-card>
      <ion-item>
      <ion-text>
      <?php echo $reverse_feeds[$x];?>
      </ion-text>
      </ion-item>

      <ion-card-content class="ion-text-center">
        <ion-icon name="time-outline" slot="start"></ion-icon>
        <ion-label><?php echo $reverse_dates[$x]; ?></ion-label>

      </ion-card-content>
    </ion-card>
		<?php endfor ?>
	</div>
  </ion-scroll>
<?php  endif ?>



