<?php

ini_set('session.use_only_cookies',1);
ini_set('session.use_strict_mode',1);

session_set_cookie_params(['lifetime' => 1800, 'domain' => 'localhost', 'path' => '/', 'secure' => true, 'httponly' => true]);

session_start();

if(isset($_SESSION["userID"])) {

  if (!isset($_SESSION["regenLast"])) {
    IdRegenSessionLoggedIn();
  } else {
    $time_required = 60 * 30;
    if(time()- $_SESSION["regenLast"] >= $time_required) {
      IdRegenSessionLoggedIn();
    }
  }

} else {

  if (!isset($_SESSION["regenLast"])) {
    IdRegenSession();
  } else {
    $time_required = 60 * 30;
    if(time()- $_SESSION["regenLast"] >= $time_required) {
      IdRegenSession();
    }
  }

}

function IdRegenSession() {
  session_regenerate_id(true);
  $_SESSION["regenLast"] = time();
}

function IdRegenSessionLoggedIn() {

  session_regenerate_id(true);
  $userID = $_SESSION["userID"];
  $newSessionId = session_create_id();
  $sessionId = newSessionId . "_" . $userID;
  session_id($sessionId);

  $_SESSION["regenLast"] = time();
}