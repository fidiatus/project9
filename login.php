<?php  
    // Lampirkan pdo dan User
    require_once "database/Connection.php";
    require_once "database/Auth.php";
    require_once "config/database.php";

    if(isset($_POST['submit'])){
        try {
            $connection = Connection::make($config);
            $pdo = new Auth($connection);
            $pdo->login($_POST['email'], $_POST['password']);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    if (isset($_SESSION['login'])) {
      header("location : index.php");
    } else {
       
    }
 ?>

<!DOCTYPE html>  
<html>  
    <head>
        <title>Login</title>
        <h1>WELLCOME to Website CILIK</h1>
    </head>
    <body>
        <div class="login-page">
          <div class="form">
            <form class="login-form" method="post">
              <?php if (isset($error)): ?>
                  <div class="error">
                      <?php echo $error ?>
                  </div>
              <?php endif; ?>
              <input type="email" name="email" placeholder="email" required/><br/>
              <input type="password" name="password" placeholder="password" required/><br/>
              <button type="submit" name="kirim">login</button><br/>
              <p class="message">Not registered? <a href="register.php">Create an account</a></p>
            </form>
          </div>
        </div>
    </body>
</html>  