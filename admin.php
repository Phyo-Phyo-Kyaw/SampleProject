<?php
      include("vendor/autoload.php");
      use Libs\Database\MySQL ;
      use Libs\Database\UsersTable ;
      use Libs\Database\RolesTable;
      use Helpers\Auth;

      $auth = Auth::check();
      $usersTable = new UsersTable(new MySQL) ;
      $users = $usersTable->getAll();

      $rolesTable = new RolesTable(new MySQL) ;
      $roles = $rolesTable->getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
      <div class="navbar bg-primary navbar-dark navbar-expand-lg">

            <div class="container my-2 fs-4">
                  <h1 class="h3">Mananger</h1>
                  <div style="float: right">
                        <b class="text-black"><?= $auth->name?>(<?= $auth->role ?>)</b> |
                        <a href="profile.php" class="text-black">Profile</a> |
                        <a href="_actions/logout.php"
                              class="text-danger">Logout</a>
                  </div>
                  
            </div>
      </div>
      
      <div class="container mt-4">
      
            <table class="table table-striped">
                  <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Actions</th>
                  </tr>

                  <?php foreach($users as $user ) : ?>
                        <tr>
                              <td><?= $user->id ?></td>
                              <td><?= htmlspecialchars($user->name) ?></td>
                              <td><?= $user->email ?></td>
                              <td><?= $user->phone ?></td>
                              <td>
                                    <?php if($user->value == 3) :?>
                                          <span class="badge bg-secondary">
                                    <?php elseif($user->value == 2) :?>
                                          <span class="badge bg-success">
                                    <?php else : ?>
                                          <span class="badge bg-primary">
                                    <?php endif ?>
                                    <?= $user->role ?>
                                          </span>
                              </td>
                              <td>
                                    <?php if($auth->value >= 2) :?>
                                          <?php if($user->suspended) : ?>
                                                <a href="_actions/unsuspend.php?id=<?= $user->id ?>" class="btn btn-warning">Activate</a>
                                          <?php else: ?>
                                                <a href="_actions/suspend.php?id=<?= $user->id ?>" class="btn btn-success">suspend</a>
                                          <?php endif ?>
                                    <?php endif ?>

                                    <?php if($auth->value >= 3) :?>
                                          <a href="#" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                                Change Role
                                          </a>
                                          <div class="dropdown-menu">
                                                <?php foreach($roles as $role) : ?>
                                                      <a href="_actions/role.php?id=<?=$user->id ?>&role=<?=$role->id?>" class="dropdown-item">
                                                            <?=$role->name?>
                                                      </a>
                                                <?php endforeach ?>
                                          </div>     
                                          <a href="_actions/delete.php?id=<?= $user->id ?>" class="btn btn-danger">Delete</a>
                                    <?php endif ?>
                                    

                              </td>
                        </tr>
                  <?php endforeach ?>
            </table>
      </div>
</body>
<script src="js/bootstrap.bundle.min.js"></script>
</html>