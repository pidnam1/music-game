<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
      <style>
  <?php include "styles/main.css" ?>
</style>
    <meta name="author" content="define author of the page -- your name">
    <meta name="description" content="define a description of this page">
    <meta name="keywords" content="define keywords for search engines">
</head>

<body>
    <nav class="navbar">
        <a class="navbar-brand" style="color: #FEFFFF" href="homepage.html">HWDYKYA?</a>

    </nav>
    <div class="center">
        <header>
            <h1>How Well Do You Know Your Artist?</h1>
        </header>
        <section class="button-sec">
            <button type="button" class="btn-lg btn-dark sign" onclick="document.location='<?=$this->url?>logging_in/'">Sign In</button>
        </section>
        <section class = "button-sec">
            <button type="button" class="btn-lg btn-dark sign" onclick="document.location='<?=$this->url?>signing_up/'">Register</button>
        </section>
    </div>
</body>

</html>