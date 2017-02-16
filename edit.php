<?php
    require_once "database/Connection.php";
    require_once "database/QueryBuilder.php";
    require_once "config/database.php";

    $connection = Connection::make($config);
    $db = new QueryBuilder($connection);
    $article = $db->find('mahasiswa',$_GET['id']);
    
    if(isset($_POST['submit'])){
        $id = $_GET['id'];
        // var_dump($id);exit;
        try {
            $db->update('mahasiswa', [
                'nim'        => $_POST['nim'],
                'nama'       => $_POST['nama'],
                'kelas'       => $_POST['kelas'],
                'prodi'      => $_POST['prodi'],
                'jurusan'    => $_POST['jurusan'],
                'id'    => $_POST['id'],
            ],$id);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">
</head>
<body>
    <form action="edit.php" method="post" accept-charset="utf-8">
        <input type="hidden" name="id" value="<?= $mhs['id']?>">
        <p>Nim</p>
        <input type="text" name="nim" value="<?= $mhs['nim']?>" placeholder="" >
        <p>Nama</p>
        <input type="text" name="nama" value="<?= $mhs['nama']?>" placeholder="" >
        <p>Kelas</p>
        <input type="text" name="kelas" value="<?= $mhs['kelas']?>" placeholder="" >
        <p>Prodi</p>
        <input type="text" name="prodi" value="<?= $mhs['prodi']?>" placeholder="" >
        <p>Jurusan</p>
        <input type="text" name="jurusan" value="<?= $mhs['jurusan']?>" placeholder="" >
        <br>
        <br>
        <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>
