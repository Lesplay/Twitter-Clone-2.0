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
                <ul class="nav navbar-nav">
                    <li><a href="main.php">Main</a></li>
                    <li><a href="messages.php">Messages</a></li>
                    <li><a href="settings.php">Settings</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" id="tweet-btn"><span class="glyphicon glyphicon-pencil"></span> Tweet</a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Log out</a></li>
                </ul>
            </div>
        </nav>
        <div id="tweet-form">
            <form method = "POST" action = "newTweet.php">
                <p>Tweet away</p>
                <textarea id="tweet-area" maxlength="140" rows="5" cols="40" name="tweet">
                        
                </textarea>
                <span id="characterCount" class="small-character-count"></span><br>
                <button type="submit" name="Tweet" class="btn btn-primary">
                    <span class="glyphicon glyphicon-check"></span>Tweet!
                </button> 
            </form>
        </div>
    </body>
</html>
