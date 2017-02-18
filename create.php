<?php
    require_once "database/Connection.php";
    require_once "database/QueryBuilder.php";
    require_once "config/database.php";

    if(isset($_POST['submit'])){
        try {
            $connection = Connection::make($config);
            $db = new QueryBuilder($connection);
            $db->insert('mahasiswa', [
                'nim' => $_POST['nim'],
                'nama' => $_POST['nama'],
                'kelas' => $_POST['kelas'],
                'prodi' => $_POST['prodi'],
                'jurusan' => $_POST['jurusan']
            ]);
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
    <title>insert</title>
</head>
<body>
<h1> Input Data Mahasiswa</h1>
    <form action="create.php" method="post" accept-charset="utf-8">
        <p>NIM
        <input type="text" name="nim" value="" placeholder="" ></p>
        <p>Nama
        <input type="text" name="nama" value="" placeholder="" ></p>
        <p>Kelas
        <input type="text" name="kelas" value="" placeholder="" ></p>
        <p>Prodi
        <input type="text" name="prodi" value="" placeholder=""></p>
        <p>Jurusan
        <input type="text" name="jurusan" value="" placeholder=""></p>
        <br/>
        <input type="submit" name="submit" value="submit"/>
    </form>
</body>
</html>
