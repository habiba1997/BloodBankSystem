<?php
session_start();
session_destroy();
header("Location:LogPage.php");
exit();
?>