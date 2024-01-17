<?php
$user = User::find_by_id(10);
$user-> username = "username";
$user-> password = "pwd";
$user-> first_name = "last_name";
$user-> last_name = "first_name";
$user ->save();
?>