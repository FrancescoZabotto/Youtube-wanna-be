<?php
    //require "base.php";
    session_start();
    session_unset();
    header('Location: home');
?>