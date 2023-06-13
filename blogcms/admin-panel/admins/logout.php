<?php 
session_start();
session_unset();
session_destroy();
header("location: http://localhost/blogcms/admin-panel/admins/login-admins.php");



?>