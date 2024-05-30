<?php
    try {
        $hostname = '192.168.2.198';
        $dbname = 'XClinic';
        $username = 'Nauta';
        $pw = '@Imn2023';
        $pdo = new PDO ("sqlsrv:Server = $hostname; DataBase=$dbname",$username,$pw);
    } catch (PDOException $e) {
        echo 'SQL ' . $e->getMessage() . '\n';
        exit;
    }

?>