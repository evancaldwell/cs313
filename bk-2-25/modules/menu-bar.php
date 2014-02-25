<nav>
    <ul>
        <?php
        require_once $_SERVER['DOCUMENT_ROOT']."/conn/connAdmin.php";
        require_once $_SERVER['DOCUMENT_ROOT']."/library/library.php";
        if(!$_SESSION['loggedin']){
        ?>
            <li><a href="/people?action=register">Register</a></li>
            <li>|</li>
            <li class="dropdown">
                <a href="/people?action=login">Login</a>
                <div>
                    <?php
                    // get the snippet for the journal entry form to use in the view
                    $loginForm = getSnippet('loginForm');
                    echo $loginForm[0];
                    ?>
                </div>
            </li>
        <?php } else { ?>
            <li><a href="****accountSettings.html">Welcome, <?php echo $_SESSION['fname'] ?></a></li>
            <li>|</li>
            <li><a href="/people?action=logmeout">Logout</a></li>
            <?php if($_SESSION['loggedin'] == true && $_SESSION['rights'] > 1): ?>
            <li><a href="/admin">Admin</a></li>
            <?php endif ?>
        <?php } ?>
    </ul>
</nav>