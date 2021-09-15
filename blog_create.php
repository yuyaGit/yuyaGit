<?php

require_once("dbc.php");
$blogs = $_POST;

$sql = "INSERT INTO blog(title,content,category,publish_status) VALUES (:title,:content,:category,:publish_status)";

$dbh = dbConnect();
$dbh->beginTransaction();
try {
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(":title", $blogs["title"], PDO::PARAM_STR);
    $stmt->bindValue(":content", $blogs["content"], PDO::PARAM_STR);
    $stmt->bindValue(":category", $blogs["category"], PDO::PARAM_INT);
    $stmt->bindValue(":publish_status", $blogs["publish_status"], PDO::PARAM_INT);
    $stmt->execute();
    echo "ブログを投稿しました";
    $dbh->commit();
} catch (PDOException $e) {
    $dbh->rollBack();
    exit($e);
}
