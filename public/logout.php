<?php
session_start();
session_unset();
session_destroy();

header("Location: /achievement-tracker/public/auth.php");
exit;
