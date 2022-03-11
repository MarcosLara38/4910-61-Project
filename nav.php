<nav>
    <div>
        <a href = "home.php">
            <img class="primary-icon" src = "pics/logo.png"/>
        </a>
    </div>
    <ul class = "nav-list">
    <!--If you are signed in show these options --> 
    <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {  ?>
        <li class = "list-item">
            <a href = "home.php">Home</a>
        </li>
        <li>
            <a href = "favorites.php">Favorites</a>
        </li>
        <li>
            <a href = "search.php">Search</a>
        </li>
        <li>
            <a href = "signout.php">Sign Out</a>
        </li>
    <?php } else{ ?>
        <!--If not signed in show these options --> 
        <li>
            <a href = "home.php">Home</a>
        </li>
        <li>
            <a href = "search.php">Search</a>
        </li>
        <li>
            <a href = "signin.php">Sign In</a>
        </li>
    <?php } ?>
    </ul>




</nav>
