<?php

    $hostname   = 'localhost';
    $dbname     = 'dbmhs';
    $username   = 'root';
    $password   = '';
	
	try {
    $pdo = new PDO("mysql:host={$hostname};dbname={$dbname}", $username, $password);
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}

      $user = new Aksi($pdo); 
