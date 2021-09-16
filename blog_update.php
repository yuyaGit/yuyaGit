<?php

require_once("dbc.php");

$blog = $_POST;

$sql = "UPDATE blog SET title=:title,content=:content,category=:category,publish_status=:publish_status WHERE id=:id";

$dbh = dbConnect();
$dbh->beginTransaction();
try {
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(":title", $blog["title"], PDO::PARAM_STR);
    $stmt->bindValue(":content", $blog["content"], PDO::PARAM_STR);
    $stmt->bindValue(":category", $blog["category"], PDO::PARAM_INT);
    $stmt->bindValue(":publish_status", $blog["publish_status"], PDO::PARAM_STR);
    $stmt->bindValue(":id", $blog["id"], PDO::PARAM_INT);
    $stmt->execute();
    echo "ブログを変更しました" . "<br>";
    echo "<a href='index.php'>戻る</a>";
    $dbh->commit();
} catch (PDOException $e) {
    $dbh->rollBack();
    exit($e);
}
