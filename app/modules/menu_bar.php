<nav id="menu-bar" class="dark-bk">
    <ul>
        <?php
        if(!isset($_SESSION['loggedin'])) {
        ?>
            <li class="dropdown">
                <a href="#">Login</a>
                <div>
                    <!--<?php
                    // get the snippet for the journal entry form to use in the view
                    //$loginForm = getSnippet('loginForm');
                    //echo $loginForm[0];
                    ?>-->
                    <form action="controllers/users.php" method="POST">
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
            <li><a href="controllers/users.php?action=logout">Logout</a></li>
            <?php if($_SESSION['loggedin'] == true && $_SESSION['rights'] < 3): ?>
            <li><a href="/admin">Admin</a></li>
            <?php endif ?>
        <?php } ?>
    </ul>
</nav>