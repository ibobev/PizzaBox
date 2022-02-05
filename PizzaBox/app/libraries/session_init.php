<?php

session_start();

function isLoggedIn()
{
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
        return true;
    }else{
        return false;
    }
}

function isLoggedInAdmin()
{
    if(isset($_SESSION['loggedinAdmin']) && $_SESSION['loggedinAdmin'] === true){
        return true;
    }else{
        return false;
    }
}

function isLoggedInDeliveryman()
{
    if(isset($_SESSION['loggedinDeliveryman']) && $_SESSION['loggedinDeliveryman'] === true){
        return true;
    }else{
        return false;
    }
}

function isCartSet()
{
    if(isset($_SESSION['cart']) && $_SESSION['loggedin'] === true && empty($_SESSION['cart'])){
        return true;
    }else{
        return false;
    }
}