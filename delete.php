<?php
    require_once "database/Connection.php";
    require_once "database/QueryBuilder.php";
    require_once "config/database.php";

    try {
        $connection = Connection::make($config);
        $pdo = new QueryBuilder($connection);
        $pdo->delete('mahasiswa',$_GET['id']);
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }

?>
