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
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="calldeezer.js"></script>

    <head>
        <script src="jquery-3.5.1.min.js"></script>
    </head>
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
                <h2>Which Song Is This?</h2>
            </header>
            <section>
                <img id="album_cover" src="">
            </section>
            <section>
                <button type="button" id="b1" class="btn-dark opt"></button>
                <button type="button" id="b2" class=" btn-dark opt"></button>
                <button type="button" id="b3" class="btn-dark opt"></button>
                <button type="button" id="b4" class=" btn-dark opt"></button>

            </section>
        </div>
        <script type='text/javascript' src='https://code.jquery.com/jquery.min.js'></script>
        <script type="text/javascript">
            let answer = -1;
            let correctlyAnswered = 0;
            let a = localStorage.getItem("artist");
            //console.log(a);
            var minutesLabel = document.getElementById("minutes");
            var secondsLabel = document.getElementById("seconds");
            var totalSeconds = 0;
            var questions = 0;
            var finalScore = 0;
            var interval = setInterval(setTime, 1000);
            $("button").click(function() {
                //alert(this.id); // or alert($(this).attr('id'));
                console.log("clicked", this.id);
                console.log("answer", "b" + answer.toString());
                if (this.id === "b" + answer.toString()) {
                    rightAnswer();
                } else {
                    timeInc(5);
                }
                loadQuestion();
            });


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
                if (questions >= 10) {
                    finalScore = totalSeconds;
                    //endTime;
                    promptEnding(correctlyAnswered, finalScore);
                }
            }

            function rightAnswer() {
                questions += 1;
                correctlyAnswered += 1;
                if (questions >= 10) {
                    finalScore = totalSeconds;

                    //endTime;
                    promptEnding(correctlyAnswered, finalScore);
                }
            }

            function promptEnding(correctlyAnswered, finalScore) {
                alert("Congrats! You answered " + correctlyAnswered + " questions correctly, and got a final time of " + finalScore + " seconds!");
                endTime();
            }

            function formatParams(params) {
                return Object.keys(params).map(function(key) {
                        return key + "=" + encodeURIComponent(params[key])
                    })
                    .join("&")
            }

            function endTime() {
                console.log("in end time");
                clearInterval(interval);
                var url = 'show_game/';
                $.post(url, {'artist': a, 'score': totalSeconds});
                window.location.href = 'http://localhost/musicgame/show_leaderboard';
            }
        </script>


</body>

</html>