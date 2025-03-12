<?php
session_start();
session_destroy();
header('Location: ../login-new.php');
exit();
?> 