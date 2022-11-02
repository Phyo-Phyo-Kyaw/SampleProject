<?php
      include("../vendor/autoload.php");
      use Libs\Database\MySQL;
      use Libs\Database\UsersTable;
      use Helpers\HTTP;
      use Helpers\Auth;

      $auth = Auth::check();
      $id = $_GET['id'];
      $table = new UsersTable(new MySQL);
      if($auth->role >= 2)
            $table->suspend($id);

      HTTP::redirect("/admin.php");