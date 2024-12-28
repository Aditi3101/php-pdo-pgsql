<?php
include("connect.php");

try {

  $statement = $pdo->prepare("SELECT id, \"studentName\", age FROM public.student ORDER BY id;");
  $statement->execute();

  $result = $statement->fetchAll();

  if (count($result) > 0) {
    foreach ($result as $row) {
      echo "<tr>";
      echo "<td>" . $row["id"] . "</td>";
      echo "<td>" . $row["studentName"] . "</td>";
      echo "<td>" . $row["age"] . "</td>";
      echo "<td>";
      echo "<button class='btn btn-warning btn-sm' id='edit_" . $row["id"] . "'>Edit</button>";
      echo "</td>";
      echo "<td>";
      echo "<button class='btn btn-danger btn-sm' id='delete_" . $row["id"] . "'>Delete</button>";
      echo "</td>";
      echo "</tr>";
    }
  } else {
    echo "<tr>";
    echo "<td colspan='5'>Record Not Found</td>";
    echo "</tr>";
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}