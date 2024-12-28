<?php

try {
  $dsn = "pgsql:host=localhost;port=5432;dbname=test;";

  $pdo = new PDO($dsn, "postgres", "1234");

  //echo "Connection Successful";

} catch (PDOException $e) {
  die($e->getMessage());
}