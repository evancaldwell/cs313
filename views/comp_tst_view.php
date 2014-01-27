<?php 
// Create or access the session
session_start();
?>
<!DOCTYPE HTML> 
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="keywords" content="coding, html, code garden,css">
        <meta name="description" content="latest information about html market">
        <title>JaED Fabrics - About Us</title>
        <!--include $_SERVER['DOCUMENT_ROOT'].'/modules/head.php';-->
        <link href="/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <section id="container">
            <nav class="menubar">
                <?php include("../modules/menu-bar.php");?>
            </nav>
            <header>
                <?php include("../modules/header.php");?>
            </header>
            <section class="main-content title-bk-img">
                <nav class="main-menu">
                    <?php include("../modules/main-menu.php");?>
                </nav>
                <!--<img class="title-bk-img" src="img/title_bk_img.png" alt="Image fades to white behind menu" />-->
                <section>
                    <h2>Testing complete MVC model</h2>
                    <ul class="page-contents">
                        <li><a href="#tst-area">Test Area</a></li>
                    </ul>
                    <div id="page-contents-shadow-right-top" class="menu-shadow menu-banner"></div>
                    <div class="page-contents-under">&nbsp;</div>
                    <?php include("../modules/half-banner.php");?>
                    <div id="tst-area" class="full-width">
                        <h3>Try / Catch</h3>
                        <p>Testing the complete MVC organization by creating a form that submits data to be written to the database and 
                        verified. The controller picks up the data from the form in the view, makes sure that something was entered in 
                        the form, calls the model and give it the form data, the model adds a new record using that data and reports back, 
                        the controller verifies that there is a new record and reports back to the view:</p>
                        <form id="regTstForm" action="comp_tst_cntrlr.php" method="post">
                            <fieldset>
                                <legend>Register</legend>
                                Enter a first name: <input type="text" name="fname" required value="<?php echo $fname ?>"><br> <!--form is 'sticky by adding the php in the value and it is required using the keyword 'required'-->
                                Enter a last name: <input type="text" name="lname" value="<?php echo $lname ?>"><br>
                                Enter an email: <input type="email" name="email" value="<?php echo $email ?>"><br>
                                Enter a password: <input type="password" name="password" value="<?php echo $password ?>"><br>
                                Confirm password: <input type="password" name="confPassword" value="<?php echo $password ?>"><br> <!--**** need to handle confPassword in the controller-->
                                Enter a access level: <input type="text" name="rights" value="<?php echo $righs ?>"><br>
                                <input type="submit" name="submit" value="Submit">
                                <input type="hidden" name="action" value="registerme"<br>
                            </fieldset>
                        </form><br>
                        <?php
                            if(!empty($output)) {
                                echo '<p>Database response: '.$output.'</p>'; 
                            } //else { 
                                //echo "show the form";
                            //}
                        
                            unset($output);
                        ?>
                        <br>
                        <br>
                        <form id="loginForm" action="comp_tst_cntrlr.php" method="post">
                            <fieldset>
                                <legend>Login</legend>
                                <input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
                                <input type="password" name="password" placeholder="Password">
                                <input type="submit" name="submit" value="Submit">
                                <input type="hidden" name="action" value="logmein">
                            </fieldset>
                        </form>
                        <br>
                        <br>
                        <?php echo ($emailList); ?>
                    </div>
                </section>
            </section>
        </section>
        <script src="//code.jquery.com/jquery-latest.min.js"></script>
        <script src="/scripts/jquery.validate.min.js"></script>
        <script src="/scripts/regRules.js"></script>
    </body>
</html>