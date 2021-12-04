<!DOCTYPE html>
<html lang="en">
<head>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <style>
  <?php include "styles/main.css" ?>
</style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1">

         <meta name="author" content="Mandip Bhadra">
         <meta name="description" content="Selection screen for artists">
         <meta name="keywords" content="Music game selection screen">
    <title>Select Artist</title>
</head>

<body>
  <nav class="navbar">
    <a class="navbar-brand" style="color: #FEFFFF" href="<?=$this->url?>home/">HWDYKYA?</a>
    <ul class="nav header">
        <li>
            <a href="<?=$this->url?>show_leaderboard/">Leaderboards</a>
        </li>
        <li>
            <a href="<?=$this->url?>select/">Select</a>
        </li>
        <li>
            <a href="<?=$this->url?>changename/">Change Profile</a>
        </li>
        <li>
            <a href="<?=$this->url?>logout/">Log Out</a>
        </li>
    </ul>
</nav>
</div>
<div class = "row select">
<div class = "d-flex justify-content-center">
<form>
  <div class="form-group justify-content-center">
    <h1>Search</h1>
    <h3 id="welcome">Hello </h3>
    <h3 id="fav_artist"></h3>
    <input type="text" class="form-control" id="artist" name="artist" placeholder="Enter artist">
    <small id="emailHelp" class="form-text text-muted">Enter an artist to either play or see leaderboard</small>
  </div>

    </form>
    </div>
    </div>

<div class = "row select">
    <div class = "d-flex justify-content-center">
    <input type="button" id="enableOnInput" class="enableOnInput btn btn-primary custom opt" onclick="validates();" disabled='disabled' value="Play"/>

        </div>
     </div>
    <div class = "row select">
    <div class = "d-flex justify-content-center">
    <input type="button" class="enableOnInput btn btn-success custom opt" id="enableOnInput" disabled='disabled' href = "<?=$this->url?>show_leaderboard/" value="Leaderboard"/>
        </div>
     </div>
    <script type='text/javascript' src='http://code.jquery.com/jquery.min.js'></script>

    <script type="text/javascript">
    $(function () {
        $('#artist').keyup(function () {
            if ($(this).val() == '') {
                $('.enableOnInput').prop('disabled', true);
            } else {
                $('.enableOnInput').prop('disabled', false);
            }
        });
    });

    welcome();
    function validates(){
    let artist =  document.getElementById("artist");
    artist = artist.value;
    console.log(artist);

    //send them to next page
    localStorage.setItem("artist", artist);
    //window.location.href = 'https://cs4640.cs.virginia.edu/mrb7bb/musicgame/show_game';
    window.location.href = 'https://192.168.64.2/musicgame/show_game';
    }



    function welcome(){
    // instantiate the object
            var ajax = new XMLHttpRequest();
            // open the request
            //ajax.open("GET", "https://cs4640.cs.virginia.edu/mrb7bb/musicgame/get_user_info/", true);
            ajax.open("GET", "https://192.168.64.2/musicgame/get_user_info/", true);
            // ask for a specific response
            ajax.responseType = "json";
            // send the request
            ajax.send(null);

            // What happens if the load succeeds
            ajax.addEventListener("load", function() {
                // set question
                if (this.status == 200) { // worked
                    userinfo = this.response;
                    console.log(userinfo);
                    displayInfo(userinfo);
                }
            });

            // What happens on error
            ajax.addEventListener("error", function() {
                alert("an error occured");
            });



    }

    function displayInfo(userInfo) {
    let fav_artist = "";
    if (userInfo.fav_artist !== null){
        fav_artist = userInfo.fav_artist;
    }
    document.getElementById("welcome").innerHTML = "Hello " + userInfo.name;
    document.getElementById("fav_artist").innerHTML = "Favorite Artist: " + fav_artist;


    }
    </script>

</body>
</html>