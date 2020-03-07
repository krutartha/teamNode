updateAnnouncements();
updateDiscussions();

$("#sendBtn").click(function() {
  var message = $("#msgText").val();
  if (message != null || message != "") {
    $.ajax({
      type: "GET",
      url: "../php/discussion.php",
      data: { postmessage: message },
      success: function(data) {
        $("#discussionBox").html(data);
      }
    });
  }
});

$("#saveChanges").click(function() {
  var username = $("#username").val();
  var email = $("#email").val();
  console.log(username, email, bio);
  $.ajax({
    type: "GET",
    url: "../php/profile.php",
    data: { username: username, email: email, bio: bio },
    success: function(data) {
      $("#result").html(data);
    }
  });
});

$("#loginBtn").click(function() {
  var username = $("#username1").val();
  var pass = $("#password1").val();
  console.log(username, pass);

  $.ajax({
    type: "GET",
    url: "../php/login.php",
    data: { username: username, pass: pass },
    success: function(data) {
      console.log("done");
    }
  });
});

function getUser(q) {
  $.ajax({
    type: "GET",
    url: "../php/team.php",
    data: "q=" + q,
    success: function(data) {
      $("#result").html(data);
    }
  });
}

$("#searchBox").on("input", function() {
  q = $(this).val();
  getUser(q);
  console.log("keypress");
});

function updateAnnouncements() {
  var msgBox = $("#discussionBox");
  $.get("../php/annoucement.php", function(data) {
    $("#announcementBox").html(data);
    window.setTimeout(updateAnnouncements, 5000);
  });
  $.get("../php/discussion.php", function(data) {
    $("#discussionBox").html(data);
    window.scrollBy(0, 1000);
    window.setTimeout(updateDiscussions, 7000);
  });
}
function updateDiscussions() {}
