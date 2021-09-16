<?php
require_once("dbc.php");

$id = $_GET["id"];
$sql = "DELETE FROM blog WHERE id=:id";

$dbh = dbConnect();
$dbh->beginTransaction();
try {
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(":id", (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    echo "ブログを削除しました" . "<br>";
    echo "<a href='index.php'>戻る</a>";
    $dbh->commit();
} catch (PDOException $e) {
    $dbh->rollBack();
    exit($e);
}
