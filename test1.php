<?php
      // include("vendor/autoload.php");
      // use Helpers\HTTP;
      // use Helpers\Auth;

      // Http::redirect('/register.php');
      // Auth::check();
      $password = "apple";
      $hash = password_hash($password , PASSWORD_DEFAULT);

      $login = "apple";
      if(password_verify($login , $hash)){
            echo "Correct password";
      } else {
            echo "Incorrect Password";
      }