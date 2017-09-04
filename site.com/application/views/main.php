<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>Welcome to MyApp</title>
    <link href="../css/font-awesome.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
</head>
<body>
	<main class="main">
		<div class="main__form">
            <form method="POST"></form>
                <p class="form__title">Log In</p>
                <div class="form__input-wrapper">
                    <label class="form__label form__ladel--email" for="input-email">Your E-mail</label>
                    <input type="text" name="email" class="form__input form__input--email" id="input-email"/>
                    
                    <label class="form__label form__label--password" for="input-password">Your Password</label>
                    <input type="password" name="password" class="form__input form__input--password" id="input-password"/>
                    
                    <div class="form__captcha-wrapper" style="display:none;">
                        <p class="form__label form__captcha-text">Secure code</p>
                        <div class="form__captcha-pic">
                            <img src="" class="form__captcha-image" alt="captcha">
                        </div>
                        <input type="text" name="captcha" class="form__input form__input--captcha" id="input-captcha" />
                        <button class="form__button form__button--captcha" onclick="checkCaptcha('login')">Check</button>
                    </div>
                    
                    <div class="form__wrapper">
                        <button class="form__button form__button--login" onclick="login()">Log In</button>
                        <button class="form__button form__button--register" onclick="showRegistrationPage()">Register</button>
                        <a class="form__link form__link--loginGoogle" href="login-google"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                    </div>
                </div>
                <p class="form__warning"></p>
            </form>
        </div>
        <p class="main__userLoggedIn">
            <? 
                if($this->session->userdata('first_name')) {
                    echo "Logged in, as ". $this->session->userdata('first_name'); 
                }else{
                    echo "Welcome to MyApp, Guest ";
                }
            ?>
        </p>
    </main>
    <script src="../js/jquery-3.2.1.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>