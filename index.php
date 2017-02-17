<?php

    require_once "database/Connection.php";
    require_once "database/Autht.php";
    require_once "config/database.php";
require_once "database/QueryBuilder.php";

        // session_start();

    // if (isset($_POST['logout'])) {
    //     $autht->logout([$_SESSION['email']]);
    // }$connection = }
    Connection::make($config);
    $db = new QueryBuilder($connection);
    if (!isset($_SESSION['login'])) {
        // header("location: login.php");
    }else{
        $email = $autht->getName($_SESSION['email']);
        $connection = Connection::make($config);
        $db = new Autht($connection);
        $email = $db->select('mahasiswa');
    }    
    $sql = "SELECT * FROM  mahasiswa";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_BOTH);

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