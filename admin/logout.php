<?php
require_once '../config.php';

unset($_SESSION['admin_logged_in']);
header('Location: login.php');
exit;
?>