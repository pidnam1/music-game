<?php

class GameController {

    private $db;

    //private $url = "/mrb7bb/musicgame/";
    private $url = "/musicgame/";

    public function __construct() {
        $this->db = new Database();
    }

    public function run($command) {

        switch($command) {
            case "select":
                $this->select();
                break;
            case "home":
                $this->home();
                break;
            case "signing_up":
                $this->signing_up();
                break;
            case "logout":
                setcookie("users", "", time() - 3600, '/');
                $this->destroySession();
                break;
            case "logging_in":
                $this->logging_in();
                break;
            case "show_leaderboard":
                $this->show_leaderboard();
                break;
            case "changename":
                $this->changename();
                break;
            case "get_user_info":
                $this->get_user_info();
                break;
            case "show_game":
                $this->show_game();
                break;
            default:
                $this->home();
                break;
        }

    }

    private function destroySession() {
        session_destroy();
        session_start();
        header("Location: {$this->url}home/");
        return;
    }

    public function changename() {
        if(isset($_POST["name"])) {
            $_SESSION["name"] = $_POST["name"];
            $change = $this -> db -> query("update user set name = ?, fav_artist = ? where email = ?;", "sss", $_POST["name"], $_POST["fav_artist"], $_SESSION["email"]);
            if($change === false) {
                $error_msg = "Error changing name";
            }
            $cookie_name = $_POST["name"];
            setcookie('name', $cookie_name, time() + 3600, '/');
            header("Location: {$this->url}select/");
            return;
        }
        include "namechange.php";
    }

    public function logging_in() {
        // our login code from index.php last time!
        $error_msg = "";
        if (isset($_POST["email"])) { /// validate the email coming in
            $data = $this -> db->query("select * from user where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            } else if (!empty($data)) {
                // user was found!
                // validate the user's password
                if (password_verify($_POST["password"], $data[0]["password"])) {
                    $_SESSION["name"] = $data[0]["name"];
                    $_SESSION["email"] = $data[0]["email"];
                    $_SESSION["age"] = 0;
                    $login_cookie = "users";
                    $login_value = $data[0]["name"];
                    setcookie($login_cookie, $login_value, time() + 3600);
                    header("Location: {$this->url}select/");
                    return;
                } else {
                    $error_msg = "Invalid Password";
                }
            } else {
                $error_msg = "Account not valid, sign up instead";
            }

        }

        include "login.php";
    }

    public function select() {

        $user = [
            "name" => $_SESSION["name"],
            "email" => $_SESSION["email"],
            "age" => $_SESSION["age"]
        ];

        include "selectscreen.php";
    }

    public function get_user_info(){
    $data = $this -> db->query("select name, fav_artist from user where email = ?;", "s", $_SESSION["email"]);
    // Return JSON only

        $user_info = $data[0];
        header("Content-type: application/json");
        echo json_encode($user_info, JSON_PRETTY_PRINT);

    }

    public function home(){

    include "homepage.php";

    if(isset($_COOKIE["users"])) {
        header("Location: {$this->url}select/");
        return;
    }
    
    }

    public function signing_up(){
    $error_msg = "";
        if (isset($_POST["email"])) { /// validate the email coming in
            $data = $this->db->query("select * from user where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            } else if (!empty($data)) {
                // user was found!
                // validate the user's password
                if ($_POST["email"] == $data[0]["email"]) {
                    $error_msg = "Account already exists, log in instead";
                }
            } else {
                if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_POST["email"])){
                    $error_msg = "Please input valid email";
                } else{
                $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $insert = $this->db->query("insert into user (name, email, password) values (?, ?, ?);", "sss", $_POST["name"], $_POST["email"], $hash);
                if ($insert === false) {
                    $error_msg = "Error creating new user";
                }
                else{
                $_SESSION["name"] = $_POST["name"];
                $_SESSION["email"] = $_POST["email"];
                $_SESSION["age"] = 0;
                $login_cookie = "users";
                $login_value = $_SESSION["name"];
                setcookie($login_cookie, $login_value, time() + 3600);
                header("Location: {$this->url}select/");
                return;
                }}
                }}
        include "signup.php";
    }

    public function show_leaderboard(){
         $error_msg = "";
         $artist = "Choose an Artist to See Their Leaderboard";
         $leaderboard = [];
         if (isset($_POST["artist"])) {
          $data = $this->db->query("select * from leaderboard where artist = ?;", "s", $_POST["artist"]);

            if ($data === false) {
                $error_msg = "Error checking for artist";

            }
            else if($_POST["artist"] == ""){
                $error_msg = "Please enter an artist";

            } else if (!empty($data)) {
         $artist = $_POST["artist"];
         $leaderboard = json_decode($data[0]["leaderboard"]);
         } else{
          $error_msg = "Artist not in database";
         }
         }

    include "leaderboards.php";

    }

    function show_game(){
        $error_msg = ""; 
        if (isset($_POST["score"])) {
            $data = $this->db->query("select * from leaderboard where artist = ?;", "s", $_POST["artist"]);
            if($data === false) {
                $arr = array($_SESSION["name"] => $_POST["score"]);
                $js = json_encode($arr);
                $base = $this->db->query("insert into leaderboard (artist, leaderboard) values (?, ?)", "ss", $_POST["artist"], $js);
                if($base === false) {
                    $error_msg = "Error creating artist leaderboard";
                }
            }
            elseif(!empty($data)) {
                $js = json_decode($data[0]["leaderboard"]);
                $arr =array($_SESSION["name"] => $_POST["score"]);
                array_push($js, $arr);
                $json = json_encode($js);
                $base = $this->db->query("update leaderboard set leaderboard = ? where artist = ?", "ss", $json, $_POST["artist"]);
                if($base === false){
                    $error_msg = "Error updating leaderboard";
                }
            }
            else {
                $error_msg = "Error fetching leaderboard data";
            }
        }
        include "gamescreen.php";
        }
    }