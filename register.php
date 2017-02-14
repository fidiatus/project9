<?php  
    // Lampirkan koneksi dan User
    require_once "database/Connection.php";
    require_once "database/aksi.php";
    require_once "config/database.php";

    if(isset($_POST['submit'])){
        try {
            $connection = Connection::make($config);
            $pdo = new Auth($connection);
            $pdo->register([
              'nama' => $_POST['nama'],
              'email' => $_POST['email'],
              'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
                
          ]);
            $sql = "INSERT INTO login (nama,email,password) VALUES  (:nama,:email,:password)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute($params);
            header("location: login.php");
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
?> 
<!DOCTYPE html>
<html>
<head>
    <title>PDO Registrasi</title>
 
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container center">
        <div class="header">
            <h2>Registrasi</h2>
        </div>
        <div class="box">
            <form action="" method="POST">
                <center></center>
                <label>Nama</label>
                <input type="text" class="control" name="nama" placeholder="Nama" required>
                <p class="error"></p>
                <label>Email</label>
                <input type="email" class="control" name="email" placeholder="Email" required>
                <p class="error"></p>
                <label>Password</label>
                <input type="password" class="control" name="password" placeholder="Password" required>
                <p class="error"></p> 
                <label>Konfirmasi Password</label>
                <input type="password" class="control" name="kpassword" placeholder="Password" required> <br/> 
                <input type="submit" name="submit" value="Register">
                    <a style="text-decoration: none" href="login.php">Login</a>
                </div>
            </form>    
        </div>
    </div>
</body>
</html>
