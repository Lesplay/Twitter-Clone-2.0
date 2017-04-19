<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Twitter-clone by Michał Oleszczuk</title>
        <meta charset="UTF-8">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="src/css/style.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="./src/js/app.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand">Twitter-clone</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" id="sign-up-btn"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="#" id="login-btn"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid form-group" id="sign-up-form">
            <form class="row" method="POST" action="newUser.php">
                <label class="register-header"><h4>Sign up TODAY!</h4></label><br>
                <div>
                    <input type="text" name="newUsername" placeholder="Your desired username" class="btn-block"><br>
                    <input type="text" name="newEmail" placeholder="Your e-mail address" class="btn-block"><br>
                    <input type="password" name="newPassword" placeholder="Your desired password" class="btn-block"><br>
                    <button type="submit" name="Sign up" class="btn btn-success btn-block">
                        <span class="glyphicon glyphicon-check"></span>&nbsp;&nbsp;Sign Up
                    </button> 
                </div>
            </form>
        </div>
        <div class="container-fluid form-group" id="login-form">
            <form class ="row" method="POST" action="userLogin.php">
                <label class="login-header"><h4>Log In!</h4></label><br>
                <div>
                    <input type="text" name="email" placeholder="Your e-mail" class="btn-block"><br>
                    <input type="password" name="password" placeholder="Your password" class="btn-block"><br>
                    <button type="submit" name="Log in" class="btn btn-primary btn-block">
                        <span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Log In
                    </button>
                </div>
            </form>
        </div>
    </body>
</html>
