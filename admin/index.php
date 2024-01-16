<?php
//include: error in the page, php generates the error
// but the page will keep working

//require:same as include with the change that php generates a fatal error
// and stops the page from working

//include_once: same as include but only once making sure that you don't load the same file multiple times bause
// it sets it in the cache
//require_once

	include ("includes/header.php");
	if (!$session->is_signed_in()) {
		header("location:login.php");
		/*redirect("login.php");*/
	}
	include ("includes/sidebar.php");
	include ("includes/content-top.php");
	include ("includes/content.php");
	include ("includes/footer.php");
?>


