// Replace the <textarea class="editor1"> with a CKEditor instance, using default configuration.
// CKEDITOR.replace( 'new-block' );

function checkPass() {
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('pass');
    var pass2 = document.getElementById('pass2');
    //Store the Confimation Message Object ...
    var message = document.getElementById('pass-match-mssg');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value) {
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    } else {
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
}



$(function() { // this is the same as $(document).ready(function(){});
  // jQuery(".expand").hide();
  // //toggle the componenet with class expander
  // jQuery(".expander").click(function(e)
  // {
  //   jQuery(this).next(".expand").slideToggle(500);

  //   // Cancel the default action
  //   e.preventDefault();
  // });

  $(".project-tile").click(function(){
    // get the projectId from the div that was clicked
    var projectId = $(this).attr("id");
    // hide the project tiles div
    $("#project-tiles").hide();
    // pull in the three main components
    $.get("views/block-input.php", {projectId: projectId}, function(data) {
        $("#block-input").html(data);
    });
    $.get("views/character_sketches.php", {projectId: projectId}, function(data) {
        $("#character-sketches").html(data);
    });
    $.get("views/chapters.php", {projectId: projectId}, function(data) {
        $("#chapters").html(data);
    });
    // then display the main-dash div
    $("#main-dash").show();
  });

  $('select').on('change', function (e) { //TODO: for some reason it is compounding ajax calls. first time calls just the four, second time 8...
      var optionSelected = $("option:selected", this);
      var valueSelected = this.value;
      $.get("views/block-input.php", {projectId: valueSelected}, function(data) {
          $("#block-input").html(data);
      });
      $.get("views/character_sketches.php", {projectId: valueSelected}, function(data) {
          $("#character-sketches").html(data);
      });
      $.get("views/chapters.php", {projectId: valueSelected}, function(data) {
          $("#chapters").html(data);
      });
  });

  // this is the id of the form
  $("#new-character").submit(function() {
      alert('hit the jquery submit');
      var url = "../views/character_sketches.php"; // the script where you handle the form input.

      $.ajax({
             type: "POST",
             url: url,
             data: $("#new-character").serialize(), // serializes the form's elements.
             success: function(data)
             {
                 alert(data); // show response from the php script.
             }
           });

      e.preventDefault(); // avoid to execute the actual submit of the form.
  });

});