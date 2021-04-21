<?php

if ($_SESSION['logged_in'])
{
    return header('location: ./pages/dashboard.php');
}
else
{
    return header('location: ./pages/login.php');
}

