<html>
    <head>
        <title>Register</title>
        <script type='text/javascript' src="/js/registration.js"></script>
    </head>

    <body>

        <?php
            echo validation_errors(); 
        ?>
        <form method="post" action="register/create" onsubmit="return checkSubmit()" name="registrationForm">
            <p>
                <label>Name</label>
                <br>
                <input type="text" name="name"/>
                <br>
            </p> 

            <p>
                <label>Email</label>
                <br>
                <input type="email" name="email"/>
                <br>
            </p>

            <p>
                <label>Password</label>
                <br>
                <input type="password" name="password"/>
                <br>
            </p>

            <p id="error"></p>

            <input type="submit" value="Register"/>            
        </form>

    </body>