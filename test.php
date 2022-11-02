<?php
      include("vendor/autoload.php") ;

      use Helpers\HTTP;
      use Helpers\Auth ;
      use Libs\Database\MySQL ;
      use Libs\Database\UsersTable ;

      $userTable = new UsersTable(new MySQL);
      $userTable->insert(
            [
                  "name" => "Bob" ,
                  "email" => "bob12@gmail.com" ,
                  "phone" => "09250890122" ,
                  "address" => "Yangon" ,
                  "password" => "password" ,
                  // "role_id" => 2 ,
            ]);
      print_r($userTable->getAll());
     /*  $mySql = new MySQL ;
      $db = $mySql->connect();
      $sql = $db->query("SELECT * from roles");
      print_r($sql->fetchAll()) ;
      echo "<br>" ; */
