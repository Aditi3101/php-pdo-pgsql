<?php

try {
  $dsn = "pgsql:host=localhost;port=5432;dbname=test;";

  $pdo = new PDO($dsn, "postgres", "password");

  //echo "Connection Successful";

} catch (PDOException $e) {
  die($e->getMessage());
}
