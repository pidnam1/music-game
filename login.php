<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="your name">
        <meta name="description" content="include some description about your page">

        <title>Trivia Game Login</title>
    <style>
  <?php include "styles/main.css" ?>
</style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    </head>

    <body>


        <div class="container" style="margin-top: 15px;">
            <div class="row col-xs-8">
                <h1>Music Game-Log In</h1>
                <p> Welcome to music game!  To get started, login below or enter a new username and password to create an account</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-4">
                <?php
                    if (!empty($error_msg)) {
                        echo "<div class='alert alert-danger'>$error_msg</div>";
                    }
                ?>
                <form action="<?=$this->url?>login/" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"/>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"/>
                    </div>

                    <div class="text-center">
                    <button type="submit" class="btn btn-primary">Log in</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>
</html>