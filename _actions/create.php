<?php
      include("../vendor/autoload.php");
      use Libs\Database\MySQL;
      use Libs\Database\UsersTable ;
      use Helpers\HTTP;

      $table = new UsersTable(new MySQL);
      if($table) {
            $table->insert([
                  "name" => $_POST['name'] ?? 'Unknown' ,
                  "email" => $_POST['email'] ?? 'Unknown' ,
                  "phone" => $_POST['phone'] ?? 'Unknown' ,
                  "address" => $_POST['address'] ?? 'Unknown' ,
                  "password" => $_POST['password'],
                  "role_id" => 1 ,
            ]);
            HTTP::redirect("/index.php" , "registered=true");
      } else {
            HTTP::redirect("/register.php" , "error=true") ;
      }
      