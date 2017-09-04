<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to MyApp</title>
    <link href="../css/main.css" rel="stylesheet">
</head>
<body>
	<main class="main">
		<div class="main__form">
            <form method="POST"></form>
                <p class="form__title">
                    <? 
                        echo "Welcome, ". $this->session->userdata('first_name'); 
                    ?>
                </p>    
                <div class="form__wrapper">
                    <button class="form__button form__button--edit" onclick="showEditPage()">Edit Profile</button>
                    <button class="form__button form__button--logout" onclick="logout()">Log Out</button>
                </div>
            </form>
        </div>
        <p class="main__userLoggedIn">
            <? 
                if($this->session->userdata('first_name')) {
                    echo "Logged in, as ". $this->session->userdata('first_name'); 
                }else{
                    echo "Welcome to MyApp, Guest";
                }
            ?>
        </p>
    </main>
    <script src="../js/jquery-3.2.1.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>