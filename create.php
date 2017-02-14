<?php
    require_once "database/Connection.php";
    require_once "database/QueryBuilder.php";
    require_once "config/database.php";

    if(isset($_POST['submit'])){
        try {
            $connection = Connection::make($config);
            $pdo = new QueryBuilder($connection);
            $pdo->insert('mahasiswa', [
                ':nim'   => $_POST['nim'],
                ':nama'   => $_POST['nama'],
                ':kelas' => $_POST['kelas'],
                ':prodi'    => $_POST['prodi'],
                ':jurusan'    => $_POST['jurusan'],
            ]);

            $sql = "INSERT INTO mahasiswa (nim,nama,kelas,prodi,jurusan) VALUES  (:nim,:nama,:kelas,:prodi,:jurusan)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute($params);

            header("location: index.php");
        }
        catch(PDOException $e){         //PDO
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
    <form action="create.php" method="post" accept-charset="utf-8">
        <p>NIM</p>
        <input type="text" name="nim" value="" placeholder="" >
        <p>Nama</p>
        <input type="text" name="nama" value="" placeholder="" >
        <p>Kelas</p>
        <input type="text" name="kelas" value="" placeholder="" >
        <p>Prodi</p>
        <input type="text" name="prodi" value="" placeholder="">
        <p>Jurusan</p>
        <input type="text" name="jurusan" value="" placeholder="">
        <br>
        <br>
        <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>
