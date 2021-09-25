<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/SignIn_styles.css">

</head>
<body>

  <div class="container">
    <div class="row content">
      <div class="col-md-6 pt-3">
        <img src="images/onlinelogomaker-031821-2357-6488-2000-transparent.png" class="img-fluid" alt="image">
      </div>
      <div class="col-md-6">
        <h3 class="signin-text mb-3">Admin Sign In</h3>
        <form action="adminLoginView.php" method="POST">
          <div class="form-group mt-4">
            <label for="email">Email</label>
            <input type="email" name="admin_email" class="form-control">
          </div>
          <div class="form-group mt-4">
            <label for="password">Password</label>
            <input type="password" name="admin_password" class="form-control">
          </div>
          <input type="submit" class="btn btn-dark mt-5" value="Login" name="">
        </form>

      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>