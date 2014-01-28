<?php
   session_start();
   $appOptions = array('writing' => 0,'freeapp' => 0,'funny' => 0,'university' => 0,'list' => 0,'learning' => 0,'mosaic' => 0);
   try {
      $resultsFile = fopen("survey_results.txt", "a+") or $message = exit("Unable to open file!");

      if (isset($_POST['name'])) {
         $name = $email = $major = $app = $comments = "";
         $name = htmlspecialchars($_POST["name"]);
         $email = htmlspecialchars($_POST["email"]);
         $major = $_POST["major"];
         $app = $_POST["app"];
         $comments = htmlspecialchars($_POST["comments"]);
         $_SESSION["voted"] = true;

         $resultString = $name."\t".$email."\t".$major."\t".$app."\t".$comments."\r\n";
         $resultsWritten = fwrite($resultsFile, $resultString);
      } else {
         if ($_SESSION['voted'] != true) {
            echo "something wrong with the post."."<br>";
         }
      }

      $allResults = array();
      while(!feof($resultsFile)) {
         $line = fgets($resultsFile);
         array_push($allResults, $line);
         foreach ($appOptions as $key => $value) {
            if (stripos($line, $key) > 0) {
               $appOptions[$key] += 1;
            }
         }
      }
      fclose($resultsFile);
   } catch (Exception $e) {
      $message = 'Message: ' .$e->getMessage();
   }
?>
<!DOCTYPE html>
<html>
   <?php include $_SERVER['DOCUMENT_ROOT'].'/modules/head.php'; ?>

   <body>
      <div class="container">
         <?php include("/modules/header.php");?>
         <main id="main">
            <div>
               <?php if (isset($message)) { ?>
               <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                     <p><?php echo $message ?></p>
                  </div>
               </div>
               <?php } ?>
               <div class="row">
                  <div class="col-md-10 col-md-offset-1" style="background:lightgrey;border:2px solid;border-radius:10px;padding:10px;">
                     <?php if (!$_SESSION['voted']) { ?>
                        <h1>Your Submission:</h1>
                        <span style="font-weight:bold">Name: </span> <span><?php echo $name; ?></span><br />
                        <span style="font-weight:bold">Email: </span> <span><?php echo $email; ?></span><br />
                        <span style="font-weight:bold">Major: </span> <span><?php echo $major; ?></span><br />
                        <span style="font-weight:bold">Chosen App: </span> <span><?php echo $app; ?></span><br />
                        <span style="font-weight:bold">Comments: </span> <span><?php echo $comments; ?></span><br />
                     <?php } else { ?>
                        <h1>You previously submitted the survey</h1>
                        <p>See the results below</p>
                        <a style="float:right; margin:-10px 10px 10px;" href="/assignments.php">Assignments</a>
                        <a style="float:right; margin:-10px 10px 10px;" href="/">Home</a>
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-10 col-md-offset-1" style="background:lightgrey;border:2px solid;border-radius:10px;padding:10px;">
                     <h1>Results</h1>
                     <p>Here are the votes for which app people are most interested in</p>
                     <table id="survey-results-table">
                        <tr>
                           <td>Writing App</td>
                           <td><?php echo $appOptions['writing']; ?></td>
                        </tr>
                        <tr>
                           <td>Free/Deals App</td>
                           <td><?php echo $appOptions['freeapp']; ?></td>
                        </tr>
                        <tr>
                           <td>Funny App</td>
                           <td><?php echo $appOptions['funny']; ?></td>
                        </tr>
                        <tr>
                           <td>School/University App</td>
                           <td><?php echo $appOptions['university']; ?></td>
                        </tr>
                        <tr>
                           <td>List App</td>
                           <td><?php echo $appOptions['list']; ?></td>
                        </tr>
                        <tr>
                           <td>Personal Learning App</td>
                           <td><?php echo $appOptions['learning']; ?></td>
                        </tr>
                        <tr>
                           <td>Photo Mosaic App</td>
                           <td><?php echo $appOptions['mosaic']; ?></td>
                        </tr>
                     </table>
                  </div>
               </div>
            </div>
         </main>
      </div>
   </body>

</html>