<?php

session_start();
unset($_SESSION['login']);
header("Refresh:0; url=".$_SERVER['HTTP_REFERER']);

?>