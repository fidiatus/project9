<?php

    require_once "database/Connection.php";
    require_once "database/Auth.php";
    require_once "config/database.php";

        session_start();

    if (isset($_POST['logout'])) {
        $auth->logout([$_SESSION['user']]);
    }
    if (!isset($_SESSION['user'])) {
        header("location: login.php");
    }else{
        $user = $auth->getName($_SESSION['user']);
        $connection = Connection::make($config);
        $pdo = new Auth($connection);
        $user = $pdo->select('mahasiswa');
    }    
 ?>
 
 <!DOCTYPE html>  
<html>  
    <head>
        <meta charset="utf-8">
        <title>Home</title>
	 <a href="create.php" >Tambah</a>
    <table border="1">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Prodi</th>
            <th>Jurusan</th>
            <th>Hapus</th>
            <th>Edit</th>
        </tr>
        <?php foreach ($mahasiswa as $mhs)  : ?>
        <tr>
            <td><?= $mhs['nim'] ?></td>
            <td><?= $mhs['nama'] ?></td>
            <td><?= $mhs['kelas'] ?></td>
            <td><?= $mhs['prodi'] ?></td>
            <td><?= $mhs['jurusan'] ?></td>
            <td>
                <a href="delete.php?id=<?= $mhs['id']?>" title="">Hapus</a>
            </td>
            <td>
                <a href="edit.php?id=<?= $mhs['id']?>" title="">Edit</a>
            </td>
        </tr>
        <?php endforeach ;?>
    </table>
        <div class="container">
            <div class="info">
                <h1>Selamat datang <?php echo $currentUser['nama'] ?></h1>
            </div>
            <a href="logout.php"><button type="button">Logout</button></a>

        </div>
    </body>
</html>