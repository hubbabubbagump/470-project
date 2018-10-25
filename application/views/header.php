<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<head>
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <div class="header">
        <label onclick="openHome()">470 Project</label>
        <div class="loginregister">
            <button class="navigate" id="login" onclick="openLogin()" type="submit">Login</button>
            <button class="navigate"id="register" onclick="openRegister()">Register</button>
        </div>
    </div>
</body>  