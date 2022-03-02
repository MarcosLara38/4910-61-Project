<nav>
    <!--If you are signed in show these options --> 
    <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {  ?>
        <a href = "home.php">Home</a>
        <a href = "favorites.php">Favorites</a>
        <a href = "search.php">Search</a>
        <a href = "signout.php">Sign Out</a>
    <?php } else{ ?>
        <!--If not signed in show these options --> 
        <a href = "home.php">Home</a>
        <a href = "search.php">Search</a>
        <a href = "signin.php">Sign In</a>
    <?php } ?>




</nav>
