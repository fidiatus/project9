<?php  
    // Lampirkan pdo dan User
    require_once "database/Connection.php";
    require_once "database/aksi.php";
    require_once "config/database.php";

    if(isset($_POST['submit'])){
        try {
            $connection = Connection::make($config);
            $pdo = new Aksi($connection);
            $pdo->login($_POST['email'], $_POST['password']);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    //jika ada data yg dikirim 
   if(isset($_POST['kirim'])){
     $email = $_POST['email']; 
     $password = $_POST['password']; 
     // Proses login user 
     if($user->login($email, $password)){ 
       header("location: index.php"); 
     }else{ 
       // Jika login gagal, ambil pesan error 
       $error = $user->getLastError(); 
     } 
   }

   $sql = "SELECT * FROM  mahasiswa";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $mahasiswa = $stmt->fetchAll(PDO::FETCH_BOTH); 
 ?>

<!DOCTYPE html>  
<html>  
    <head>
        <meta charset="utf-8">

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
      <table border="1">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Prodi</th>
            <th>Jurusan</th>
        </tr>
        <?php foreach ($mahasiswa as $mhs)  : ?>
        <tr>
            <td><?= $mhs['nim'] ?></td>
            <td><?= $mhs['nama'] ?></td>
            <td><?= $mhs['kelas'] ?></td>
            <td><?= $mhs['prodi'] ?></td>
            <td><?= $mhs['jurusan'] ?></td>
        </tr>
        <?php endforeach ;?>
    </table>
            </form>
          </div>
        </div>
    </body>
</html>  