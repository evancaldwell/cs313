<?php

   $name = $email = $major = $visited_places = $comments = "";
   $name = htmlspecialchars($_POST["name"]);
   $email = htmlspecialchars($_POST["email"]);
   $major = $_POST["major"];
   $visited_places = $_POST["places"];
   $comments = htmlspecialchars($_POST["comments"]);
?>

<!DOCTYPE html>
<html>
   <?php include $_SERVER['DOCUMENT_ROOT'].'/modules/head.php'; ?>

   <body>
      <div>
         <div class="row">
            <div class="col-md-10 col-md-offset-1" style="background:lightgrey;border:2px solid;border-radius:10px;padding:10px;">
               <h1>Student Information</h1>
               <span style="font-weight:bold">Name: </span> <span><?php echo $name; ?></span><br />
               <span style="font-weight:bold">Email: </span> <span><?php echo $email; ?></span><br />
               <span style="font-weight:bold">Major: </span> <span><?php echo $major; ?></span><br />
               <span style="font-weight:bold">Places Visited: </span> 
               <span>
                  <ul>
                     <?php
                        for($i = 0; $i < count($visited_places); $i++)
                        {
                           echo "<li>". $visited_places[$i]."</li>";

                        }
                     ?>
                  </ul>
               </span><br />
               <span style="font-weight:bold">Comments: </span> <span><?php echo $comments; ?></span><br />
            </div>
         </div>
      </div>
   </body>

</html>