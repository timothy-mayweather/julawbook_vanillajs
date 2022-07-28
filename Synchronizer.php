<?php
//
//function master_connect(): ?PDO
//{
//    try {
//        $connection = new PDO("sqlite:database/master.sqlite");
//        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        return $connection;
//    } catch (PDOException $e) {
//        echo "Connection failed: " . $e->getMessage();
//    }
//    return null;
//}
//
//function slave_connection(): ?PDO
//{
//    try {
//        $connection = new PDO("sqlite:database/slave.sqlite");
//        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        return $connection;
//    } catch (PDOException $e) {
//        echo "Connection failed: " . $e->getMessage();
//    }
//    return null;
//}
//
//function check_master(): void
//{
//
//}
