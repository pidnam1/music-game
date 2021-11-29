<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/main.css">
    <meta name="author" content="define author of the page -- your name">
    <meta name="description" content="define a description of this page">
    <meta name="keywords" content="define keywords for search engines">
</head>

<body>
    <nav class="navbar">
        <a class="navbar-brand" style="color: #FEFFFF" href="homepage.html">HWDYKYA?</a>
        <ul class="nav header">
            <li>
                <a href="<?= $this->url ?>show_leaderboard/">Leaderboards</a>
            </li>
            <li>
                <a href="<?= $this->url ?>select/">Select</a>
            </li>
            <li>
                <a href="<?= $this->url ?>changename/">Change Name</a>
            </li>
            <li>
                <a href="<?= $this->url ?>logout/">Log Out</a>
            </li>
        </ul>
    </nav>
    <div class="center" style="padding: 10px">
        <span id="minutes"></span>:
        <span id="seconds"></span>
        <div class="center" style="padding: 10px">
            <header>
                <h1>Which Song Is This?</h1>
            </header>
            <section>
                <img id="album_cover" src="">
            </section>
            <section>
                    <button type="button" id="b1" onclick="rightAnswer(); fetchSongs();" class="btn-lg btn-dark opt"></button>
                    <button type="button" id="b2" onclick="timeInc(5); fetchSongs();" class="btn-lg btn-dark opt"></button>
                    <button type="button" id="b3" onclick="timeInc(5); fetchSongs();" class="btn-lg btn-dark opt"></button>
                    <button type="button" id="b4" onclick="timeInc(5); fetchSongs();" class="btn-lg btn-dark opt"></button>
                
            </section>
        </div>
        <script type="text/javascript">
            let a = localStorage.getItem("artist");
            console.log(a);
            var minutesLabel = document.getElementById("minutes");
            var secondsLabel = document.getElementById("seconds");
            var totalSeconds = 0;
            var questions = 0;
            var finalScore = 0;
            var interval = setInterval(setTime, 1000);

            function setTime() {
                ++totalSeconds;
                secondsLabel.innerHTML = pad(totalSeconds % 60);
                minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
            }

            function pad(val) {
                var valString = val + "";
                if (valString.length < 2) {
                    return "0" + valString;
                } else {
                    return valString;
                }
            }

            var timeInc = function(time) {
                totalSeconds += time;
                questions += 1;
                if (question >= 10) {
                    finalScore = totalSeconds;
                    endTime;
                }
            }

            function rightAnswer() {
                questions += 1;
                if (questions >= 10) {
                    finalScore = totalSeconds;
                    endTime;
                }
            }

            function endTime() {
                clearInterval(interval);
                var xhr = new XMLHttpRequest();
                xhr.open("POST", /musicgame/show_game, true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send(score = finalScore);
            }
        </script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script type="text/javascript" src="calldeezer.js"></script>

</body>

</html>