<nav id="menu-bar">
    <ul>
        <?php
        require_once $_SERVER['DOCUMENT_ROOT']."/library/library.php";
        if(!isset($_SESSION['loggedin'])) {
        ?>
            <li class="dropdown">
                <a href="../controllers/users.php?action=registerView">Register</a>
                <div>
                    <form action="/app/controllers/users.php" method="POST">
                        <fieldset>
                        <input type="text" name="email" placeholder="Email">
                        <input type="password" name="pass" id="pass" placeholder="Password">
                        <input type="password" name="pass2" id="pass2" onkeyup="checkPass(); return false;" placeholder="Confirm Password">
                        <span id="pass-match-mssg"></span>
                        </fieldset>
                        <fieldset>
                        <input type="text" name="fname" placeholder="First Name">
                        <input type="text" name="lname" placeholder="Last Name">
                        <input type="text" name="phone" placeholder="Phone Number">
                        <input type="text" name="addr1" placeholder="Street Address">
                        <input type="text" name="addr2" placeholder="Apt. #...">
                        <input type="text" name="city" placeholder="City">
                        <input type="text" name="state" placeholder="State">
                        <input type="text" name="zip" placeholder="Zip">
                        </fieldset>
                        <input type="submit" value="Register">
                        <input type="hidden" name="action" value="register">
                    </form>
                </div>
            </li>
            <li>|</li>
            <li class="dropdown">
                <a href="/people?action=loginView">Login</a>
                <div>
                    <!--<?php
                    // get the snippet for the journal entry form to use in the view
                    //$loginForm = getSnippet('loginForm');
                    //echo $loginForm[0];
                    ?>-->
                    <form action="/app/controllers/users.php" method="POST">
                        <input type="text" name="email" placeholder="email">
                        <input type="password" name="password" placeholder="password">
                        <input type="submit" value="Login">
                        <input type="hidden" name="action" value="login">   
                    </form>
                </div>
            </li>
        <?php } else { ?>
            <li><a href="****accountSettings.html">Welcome, <?php echo $_SESSION['fname'] ?></a></li>
            <li>|</li>
            <li><a href="/app/controllers/users.php?action=logout">Logout</a></li>
            <?php if($_SESSION['loggedin'] == true && $_SESSION['rights'] < 3): ?>
            <li><a href="/admin">Admin</a></li>
            <?php endif ?>
        <?php } ?>
    </ul>
</nav>