<?php

class GameController {

    private $db;

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
            case "sign_up":
                $this->sign_up();
                break;
            case "logout":
                $this->destroySession();
                break;
            case "login":
                $this->login();
                break;
            case "leaderboard":
                $this->leaderboard();
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

    public function login() {
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

    public function home(){


    include "homepage.php";

    }

    public function sign_up(){
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
                header("Location: {$this->url}select/");
                return;
                }}
                }}
        include "sign_up.php";
    }

    public function leaderboard(){
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

    include "leaderboard.php";

    }


    }