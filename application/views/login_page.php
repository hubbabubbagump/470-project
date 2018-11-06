<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8" />

        <link rel="stylesheet" href="/css/header.css">
        <link rel="stylesheet" href="/css/login.css">
        
    </head>

    <body>
        <h1>Login</h1>
        <div class="loginContainer">
            <div class="signin">  
                <?php
                    echo validation_errors(); 
                ?>
                <form name="loginForm" onsubmit="event.preventDefault(); return checkSubmit()">
                    <p>
                        <label><b>Email</b></label>
                        <br>
                        <input autofocus id="email" type="email" name="email" placeholder="Enter Email" value="<?php echo $email; ?>"/>
                        <br>
                    </p>

                    <p>
                        <label><b>Password</b></label>
                        <br>
                        <input type="password" name="password" placeholder="Enter Password"/>
                        <br>
                    </p>

                    <p id="error"></p>

                    <input class="userbutton" type="submit" value="Login"/>            
                </form>

            </div>
        </div>
        <script src="/js/jquery-3.3.1.min.js"></script>
        <script type='text/javascript' src="/js/login.js"></script>
        <script type='text/javascript' src="/js/header.js"></script>
    </body>
</html>