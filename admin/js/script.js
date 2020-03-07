$(function() {
  $("#navbar").load("./components/navbar.html");
});

$("#makeAnnouncement").on("click", function() {
  announcement = $("#announcementBox").val();
  $.ajax({
    type: "GET",
    url: "../php/announcement.php",
    data: { announcement: announcement },
    success: function(data) {
      $("#result").html(data);
    }
  });
});
