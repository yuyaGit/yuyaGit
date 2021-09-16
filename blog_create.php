<?php

require_once("dbc.php");

$result = $_POST;

$sql = "INSERT INTO blog(title,content,category,publish_status) VALUES (:title,:content,:category,:publish_status)";


$dbh = dbConnect();
$dbh->beginTransaction();
try {
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(":title", $result["title"], PDO::PARAM_STR);
    $stmt->bindValue(":content", $result["content"], PDO::PARAM_STR);
    $stmt->bindValue(":category", $result["category"], PDO::PARAM_INT);
    $stmt->bindValue(":publish_status", $result["publish_status"], PDO::PARAM_STR);
    $stmt->execute();
    echo "ブログを投稿しました";
    echo "<a href='index.php'>戻る</a>";
    $dbh->commit();
} catch (PDOException $e) {
    $dbh->rollBack();
    exit($e);
}
