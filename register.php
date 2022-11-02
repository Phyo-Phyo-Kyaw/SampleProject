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
      <div class="container mt-4 text-center" style="max-width : 580px">
            <h1 class="h4">Register</h1>
            <?php if(isset($_GET['error'])) : ?>
                  <div class="alert alert-warning">
                        Cannot create account. Please try again.
                  </div>
            <?php endif ?>
            <form action="_actions/create.php" method="POST">
                  <input type="text" class="form-control mb-2" name="name" placeholder="Name" required>
                  <input type="email" class="form-control mb-2" name="email" placeholder="Email" required>
                  <input type="text" class="form-control mb-2" name="phone" placeholder="Phone" required>
                  <textarea class="form-control mb-2" name="address" placeholder="Address" required></textarea>
                  <input type="password" class="form-control mb-2" name="password" placeholder="Password" required>
                  <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
            </form>
            <br>
            <a href="index.php">Login</a>
      </div>
</body>
</html>