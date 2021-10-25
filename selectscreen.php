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
            <a href="gamescreen.html">Game</a>
        </li>
        <li>
            <a href="<?=$this->url?>leaderboard/">Leaderboards</a>
        </li>
        <li>
            <a href="selectscreen.html">Select</a>
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
    <h3>Hello <?=$user["name"]?>! Age: <?=$user["age"]?></h3>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter artist">
    <small id="emailHelp" class="form-text text-muted">Enter an artist to either play or see leaderboard</small>
  </div>

    </form>
    </div>
    </div>

<div class = "row select">
    <div class = "d-flex justify-content-center">
    <a class="btn btn-primary custom opt" href = "gamescreen.html">Play </a>
        </div>
     </div>
    <div class = "row select">
    <div class = "d-flex justify-content-center">
    <a class="btn btn-success custom opt" href = "leaderboard.html">Leaderboard </a>
        </div>
     </div>


</body>
</html>