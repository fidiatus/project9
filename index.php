<?php

    require_once "database/Connection.php";
    require_once "database/Autht.php";
    require_once "config/database.php";
    require_once "database/QueryBuilder.php";

    $connection = Connection::make($config);
    $db = new QueryBuilder($connection);
    $mhs = $db->select('mahasiswa');
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
        <?php foreach ($mhs as $m)  : ?>
        <tr>
            <td><?= $m->nim; ?></td>
            <td><?= $m->nama; ?></td>
            <td><?= $m->kelas; ?></td>
            <td><?= $m->prodi; ?></td>
            <td><?= $m->jurusan; ?></td>
            <td>
                <a href="delete.php?id=<?= $m->id; ?>" title="">Hapus</a>
            </td>
            <td>
                <a href="edit.php?id=<?= $m->id; ?>" title="">Edit</a>
            </td>
        </tr>
        <?php endforeach ;?>
    </table>
        <div class="container">
            <a href="logout.php"><button type="button">Logout</button></a>

        </div>
    </body>
</html>