<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$loginsuccess = 0;
$_SESSION['loginsuccess'] = $loginsuccess;


?>