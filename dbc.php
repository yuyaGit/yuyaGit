<?php

function dbConnect()
{
    $dsn = "mysql:host=localhost;dbname=blog_app;charset=utf8";
    $user = "yuya";
    $pass = "root";

    try {
        $dbh = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
    return $dbh;
}

function getDBdata()
{
    $dbh = dbConnect();
    $sql = "SELECT * FROM blog";
    $stmt = $dbh->query($sql);
    return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
}

function getBlog($id)
{

    $dbh = dbConnect();

    $stmt = $dbh->prepare("SELECT * FROM blog Where id = :id");
    $stmt->bindValue(":id", (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}
$result = getDBdata();
