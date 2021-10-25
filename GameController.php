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
                if (password_verify($_POST["password"], $data[0]["password"])) {
                    $error_msg = "Account already exists, log in instead";
                } else {
                    $error_msg = "Invalid Password";
                }
            } else {
        $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $insert = $this->db->query("insert into user (name, email, password) values (?, ?, ?);", "sss", $_POST["name"], $_POST["email"], $hash);
                if ($insert === false) {
                    $error_msg = "Error creating new user";
                }

                $_SESSION["name"] = $_POST["name"];
                $_SESSION["email"] = $_POST["email"];
                $_SESSION["age"] = 0;
                header("Location: {$this->url}select/");
                return;
                }
                }
        include "sign_up.php";
    }

    public function leaderboard(){


    include "leaderboard.php";

    }


    }