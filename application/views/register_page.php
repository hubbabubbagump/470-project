<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <meta charset="UTF-8" />
        
        <link rel="stylesheet" href="/css/login.css">
        <link rel="stylesheet" href="/css/header.css">
    </head>

    <body>
        <h1>Register</h1>
        <div class="loginContainer">
            <div class="signin">
                <?php
                    echo validation_errors(); 
                ?>
                <form onsubmit="event.preventDefault(); return checkSubmit()" name="registrationForm">
                    <p>
                        <label class="required"><b>Name</b></label>
                        <br>
                        <input autofocus type="text" name="name" placeholder="Enter Name" value="<?php echo $name; ?>"/>
                        <br>
                    </p> 

                    <p>
                        <label class="required"><b>Email</b></label>
                        <br>
                        <input type="email" name="email" placeholder="Enter Email" value="<?php echo $email; ?>"/>
                        <br>
                    </p>

                    <p>
                        <label class="required"><b>Password</b></label>
                        <br>
                        <input type="password" name="password" placeholder="Enter Password"/>
                        <br>
                    </p>

                    <p id="error"></p>

                    <input class="userbutton" type="submit" value="Register"/>            
                </form>
            </div>
        </div>

        <script src="/js/jquery-3.3.1.min.js"></script>
        <script type='text/javascript' src="/js/registration.js"></script>
        <script type='text/javascript' src="/js/header.js"></script>
    </body>
</html>