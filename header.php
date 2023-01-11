<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GiveGet</title>

    <link rel="stylesheet" href="site.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&family=Lato&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="scripts/effects.js"></script>
    <script src="m6-contactjs.js"></script>
    <script src="validation.js"></script>
    <script src="useraccount.js"></script>
    
</head>
<body>
        <header>
            <div class="header_top">

            <?php
            if(isset($_SESSION["user_id"])){
                ?>
                <a href="useraccount.php">
                    <button id="signin_btn" style="width:auto;">Your Account</button>
                </a>
                <?php
            }
            else{
                ?>
                <button id="signin_btn" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Sign In</button>
                <?php

            }
            ?>    

                <span class="title" style="color:rgb(83, 221, 231); text-shadow: 2px 2px 4px #000000;"><b>Give</b></span><span class="title">Get</span><br/>
                <span id="slogan">Getting the job done together<br/></span>
               
            </div>
            <!--This is for the popup modal sign-in box-->
            <?php 
                require 'signinup.php'; 
            ?>
            
        </header>
