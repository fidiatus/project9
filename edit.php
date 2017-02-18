<?php
    require_once "database/Connection.php";
    require_once "database/QueryBuilder.php";
    require_once "config/database.php";

    $connection = Connection::make($config);
    $db = new QueryBuilder($connection);
    $mhs = $db->find('mahasiswa',$_GET['id']);
    
    if(isset($_POST['submit'])){
        $id = $_GET['id'];
        // var_dump($id);exit;
        try {
            $db->update('mahasiswa', [
                'nim'        => $_POST['nim'],
                'nama'       => $_POST['nama'],
                'kelas'      => $_POST['kelas'],
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
    <title>edit</title>
    <link rel="stylesheet" href="">
</head>
<body>
<h2> Edit Data Mahasiswa</h2>
    <form action="edit.php?id=<?=$mhs[0]->id; ?>" method="post" accept-charset="utf-8">
        <p>Nim
        <input type="text" name="nim" value="<?= $mhs[0]->nim; ?>" placeholder="" ></p>
        <p>Nama
        <input type="text" name="nama" value="<?= $mhs[0]->nama; ?>" placeholder="" ></p>
        <p>Kelas
        <input type="text" name="kelas" value="<?= $mhs[0]->kelas; ?>" placeholder="" ></p>
        <p>Prodi
        <input type="text" name="prodi" value="<?= $mhs[0]->prodi; ?>" placeholder="" ></p>
        <p>Jurusan
        <input type="text" name="jurusan" value="<?= $mhs[0]->jurusan; ?>" placeholder="" ></p>
        <br>
        <br>
        <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>
