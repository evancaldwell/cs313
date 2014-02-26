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
  jQuery(".expand").hide();
  //toggle the componenet with class expander
  jQuery(".expander").click(function(e)
  {
    jQuery(this).next(".expand").slideToggle(500);

    // Cancel the default action
    e.preventDefault();
  });

  function getComponents(){ // turn this into the function tat gets called when things are changed
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
  }

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
  
});

// function handleNewProjectClick(e) {
//       var url = "../controllers/blocks.php"; // the script where you handle the form input.
//       var projectTitle = document.getElementById('project-title').value;
//       var projectDesc = document.getElementById('project-desc').value;

//       $.ajax({
//         type: "POST",
//         url: url,
//         data: {action: "newProject", projectTitle: projectTitle, projectDesc: projectDesc, projectId: 1},
//         success: function(data)
//         {
//           // var returnedData = JSON.parse('<?php echo $data ?>');
//           alert('returned data: ' + data); // show response from the php script.
//           //could call a second function to recal the character-sketches.php.
//           $.get("views/character_sketches.php", {projectId: data.projectId}, function(data) {
//               $("#character-sketches").html(data);
//           });
//         }
//       });

//       e.preventDefault(); // avoid to execute the actual submit of the form.
//   }

function handleNewCharacterClick(e) {
      var url = "controllers/blocks.php"; // the script where you handle the form input.
      var characterName = document.getElementById('character-name').value;
      var characterDescription = document.getElementById('character-desc').value;

      $.ajax({
        type: "POST",
        url: url,
        data: {action: "newCharacter", characterName: characterName, characterDesc: characterDescription},
        success: function(data)
        {
          // var returnedData = JSON.parse('<?php echo $data ?>');
          alert('returned data: ' + data); // show response from the php script.
          //could call a second function to recal the character-sketches.php.
          $.get("views/character_sketches.php", {projectId: data.projectId}, function(data) {
              $("#character-sketches").html(data);
          });
        }
      });

      e.preventDefault(); // avoid to execute the actual submit of the form.
  }

function handleNewChapterClick(e) {
      var url = "controllers/blocks.php"; // the script where you handle the form input.
      var chapterNum = document.getElementById('chapter-number').value;
      var chapterName = document.getElementById('chapter-name').value;

      $.ajax({
        type: "POST",
        url: url,
        data: {action: "newChapter", chapterNum: chapterNum, chapterName: chapterName, projectId: 1},
        success: function(data)
        {
          // var returnedData = JSON.parse('<?php echo $data ?>');
          alert('returned data: ' + data); // show response from the php script.
          //could call a second function to recal the character-sketches.php.
          $.get("views/chapters.php", {projectId: data.projectId}, function(data) {
              $("#chapters").html(data);
          });
          $.get("views/block-input.php", {projectId: data.projectId}, function(data) {
              $("#block-input").html(data);
          });
        }
      });

      e.preventDefault(); // avoid to execute the actual submit of the form.
  }

function handleNewBlockClick(e) {
      var url = "controllers/blocks.php"; // the script where you handle the form input.
      var blockContent = document.getElementById('block-content').value;
      var chapter = document.getElementById('block-chapter-select').value;

      $.ajax({
        type: "POST",
        url: url,
        data: {action: "newBlock", blockContent: blockContent, chapter: chapter},
        success: function(data)
        {
          // var returnedData = JSON.parse('<?php echo $data ?>');
          // alert('returned data: ' + data); // show response from the php script.
          //could call a second function to recal the character-sketches.php.
          $.get("views/block-input.php", {projectId: data.projectId}, function(data) {
              $("#block-input").html(data);
          });
        }
      });

      e.preventDefault(); // avoid to execute the actual submit of the form.
  }