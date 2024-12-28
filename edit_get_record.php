<?php
include("connect.php");

try {
  $id = $_POST["id"];

  $statement = $pdo->prepare("SELECT id, \"studentName\", age FROM public.student WHERE id=$id;");
  $statement->execute();

  $row = $statement->fetch(PDO::FETCH_ASSOC);

  echo json_encode($row);
} catch (PDOException $e) {
  echo $e->getMessage();
}