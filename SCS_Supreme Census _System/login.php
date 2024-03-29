<?php
    session_unset();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="./css/login.css">
    </head>
    <body>
        <div class="wrapper">
            <form action="#">
                <h2>Login</h2>
                <div class="input-field">
                    <input type="text" required placeholder="Enter your Email">
                </div>
                <div class="input-field">
                    <input type="password" required placeholder="Enter Your Password">
                </div>
                <div class="forget">
                    <label for="remember">
                        <input type="checkbox" id="remember">
                        <p>Remember me</p>
                    </label>
                    <a href="#">Forgot password?</a>
                </div>
                <a href="index.html" type="submit">Log In</a>
                <div class="register">
                    <p>Dont have an account? <a href="signup.html">Sign In</a></p>
                </div>
            </form>
        </div>
    </body>
</html>=