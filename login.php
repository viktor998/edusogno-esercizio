<?php
  require_once __DIR__ . "/Models/User.php";

  if(session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  if(isset($_POST["email"]) && isset($_POST["password"]) && $_POST["email"] != "" && $_POST["password"] != "") {
    // var_dump("Check user credentials");

    $result = User::find($_POST["email"], $_POST["password"]);

    if($result && $result -> num_rows) {
      $_SESSION["authenticated"] = true;
      $user = $result -> fetch_assoc();
      // var_dump($user);
      $_SESSION["userId"] = $user["id"];
      $_SESSION["email"] = $user["email"];
      // var_dump(DIR);
      if($_SESSION["email"] === 'admin@edusogno.com') {
        header('Location: Admin/dashboard.php');
      } else{
        header('Location: dashboard.php');
      }
    } elseif($result) {
      // echo "No results";
      $_SESSION["errors"] = null;
      $_SESSION["authenticated"] = false;
      header('Location: index.php');
    } else {
      echo "Query error";
    }
  } else {
    // echo "Missing validation";
    $_SESSION["authenticated"] = null;
    $_SESSION["errors"] = "All fields must be filled";
    header('Location: index.php');
  }
  session_write_close();