<?php

    session_start(); 


    // if the user is logged in, unset the session 
    if (isset($_SESSION['ID'])) 
    { 
        unset($_SESSION['ID']); 
    } 
    session_destroy(); //destroy the session


    // go to login page 
    header('Location: dashboard.html'); 
    exit; 

?>