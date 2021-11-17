<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="your name">
        <meta name="description" content="include some description about your page">

        <title>Music Game Change Profile</title>
    <style>
  <?php include "styles/main.css" ?>
</style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    </head>

    <body>


        <div class="container" style="margin-top: 15px;">
            <div class="row col-xs-8">
                <h1>Music Game Profile Change</h1>
                <p> You can change your details here! </p>
            </div>
            <div class="row justify-content-center">
                <div class="col-4">
                <?php
                    if (!empty($error_msg)) {
                        echo "<div class='alert alert-danger'>$error_msg</div>";
                    }
                ?>
                <form action="<?=$this->url?>changename/" method="post" onsubmit="return validates();">
                    <div class="mb-3">
                        <label for="name" class="form-label">New Name</label>
                        <input type="name" class="form-control" id="name" name="name"/>
                        <label for="fav_artist" class="form-label">Favorite Artist</label>
                        <input type="fav_artist" class="form-control" id="fav_artist" name="fav_artist"/>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Name</button>
                </div>

                </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <script type="text/javascript">
        function validates(){
    let name=  document.getElementById("name");
    name = name.value;

    console.log(name);
    let fav_artist=  document.getElementById("fav_artist");
    fav_artist = fav_artist.value;

    console.log(fav_artist);

    if (name === "" || fav_artist === "") {
    alert("Please fill in all input");
    return false;
    }
    else{
    return true;
    }
    }
    </script>
    </body>
</html>