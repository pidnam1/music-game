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
         <meta name="description" content="Leaderboard">
         <meta name="keywords" content="Leaderboard lookup for scores related to artists">
    <title>Leaderboard</title>
</head>
<body>
  <nav class="navbar">
    <a class="navbar-brand" style="color: #FEFFFF" href="<?=$this->url?>home/">HWDYKYA?</a>
    <ul class="nav header">
        <li>
            <a href="gamescreen.html">Game</a>
        </li>
        <li>
            <a href="leaderboard.html">Leaderboards</a>
        </li>
        <li>
            <a href="selectscreen.html">Select</a>
        </li>
    </ul>
</nav>

<div class = "row leaderboard">
<h1>Leaderboard</h1>
    </div>
<div class = "row leaderboard">
<div class = "d-flex justify-content-center">
<form action="<?=$this->url?>leaderboard/" method="post">
  <div class="form-group justify-content-center">
    <label for="exampleInputEmail1">Search</label>
    <input type="artist" class="form-control" id="artist" name = "artist" aria-describedby="emailHelp" placeholder="Enter artist">
    <small id="emailHelp" class="form-text text-muted">Enter an artist to see their leaderboard</small>
    <?php
                    if (!empty($error_msg)) {
                        echo "<div class='alert alert-danger'>$error_msg</div>";
                    }
                ?>
  </div>
  <button type="submit" class="btn btn-primary">Search</button>

    </form>
    </div>
    </div>

<h3 class = "artist"><?=$artist?></h3>
<div class = "row board">

    <div class="form-group justify-content-center">
<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Time</th>
    </tr>
  </thead>

  <tbody>
  <?php
  if (isset($_POST["artist"])) {
    $counter = 1;
    foreach($leaderboard as $key => $val) {
    echo "<tr>";
    echo "<th scope='row'>".$counter."</th>";
    echo  "<td>".$key."</td>";
    echo  "<td>".$val."</td>";
    echo "</tr>";
    $counter += 1;
    }
    }
    ?>
  </tbody>
</table>
    </div>
    </div>


</body>
</html>