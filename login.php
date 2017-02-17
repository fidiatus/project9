<?php  
    // Lampirkan pdo dan User
    require_once "database/Connection.php";
    require_once "database/Autht.php";
    require_once "config/database.php";

    if(isset($_POST['kirim'])){
        try {
            $connection = Connection::make($config);
            $db = new Autht($connection);
            $db->login($_POST['username'], $_POST['email'], $_POST['password']);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    if (isset($_SESSION['email'])) {
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
            <form class="login-form" action="" method="post">
              <?php if (isset($error)): ?>
                  <div class="error">
                      <?php echo $error ?>
                  </div>
              <?php endif; ?>
              <input type="text" name="username" placeholder="username" required/><br/><br/>
              <input type="email" name="email" placeholder="email" required/><br/><br/>
              <input type="password" name="password" placeholder="password" required/><br/><br/>
              <button type="submit" name="kirim">login</button><br/><br/>
              <p class="message">Not registered? <a href="register.php">Create an account</a></p>
            </form>
          </div>
        </div>
    </body>
</html>  