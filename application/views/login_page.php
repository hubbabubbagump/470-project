<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8" />

        <script type='text/javascript' src="/js/login.js"></script>
        <script type='text/javascript' src="/js/header.js"></script>
        <link rel="stylesheet" href="/css/header.css">
        <link rel="stylesheet" href="/css/login.css">
    </head>

    <body>
        <h1>Login</h1>
        <div class="container">
            <div class="signin">  
                <?php
                    echo validation_errors(); 
                ?>
                <form method="post" action="login/login" onsubmit="return checkSubmit()" name="loginForm">
                    <p>
                        <label><b>Email</b></label>
                        <br>
                        <input type="email" name="email" placeholder="Enter Email"/>
                        <br>
                    </p>

                    <p>
                        <label><b>Password</b></label>
                        <br>
                        <input type="password" name="password" placeholder="Enter Password"/>
                        <br>
                    </p>

                    <p id="error"></p>

                    <input class="button" type="submit" value="Login"/>            
                </form>

            </div>
        </div>

    </body>