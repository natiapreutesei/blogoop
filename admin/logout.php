<?php
    require_once("includes/header.php");
    $session ->logout();
    header("location:login.php");
?>