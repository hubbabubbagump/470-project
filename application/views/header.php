<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<body>
    <div class="header">
        <div class="labelContainer"><label onclick="openHome()">470 Project</label></div>  
        <div class="loginregister">
        <?php if ($showLogin): ?>
            <div class="buttonContainer" onclick="openLogin()"><p class="navigate login" id="login">Login</p></div>
            <div class="buttonContainer" onclick="openRegister()"><p class="navigate register"id="register">Register</p></div>
        <?php else: ?>
            <div class="buttonContainer" onclick="openPostItem()"><button class="navigate" id="addItem">Post New Item</button></div>
            <div class="buttonContainer" onclick="openLogout()"><button class="navigate" id="logout">Logout</button></div>
        <?php endif; ?>
        </div>
    </div>
</body>