<?php

//include: error in the page, php generates the error
// but the page will keep working

//require:same as include with the change that php generates a fatal error
// and stops the page from working

//include_once: same as include but only once making sure that you don't load the same file multiple times bause
// it sets it in the cache
//require_once
include("includes/header.php");
include("includes/sidebar.php");
include("includes/content-top.php");
?>
    <h1>All posts</h1>
    <p>Here we will see all the posts in the database</p>
<?php
include("includes/footer.php");
?>