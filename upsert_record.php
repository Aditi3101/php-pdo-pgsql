<?php
try {
  include("connect.php");

  $action = $_POST["action"];
  $id = $_POST["id"];
  $studentName = $_POST["studentName"];
  $age = $_POST["age"];

  if (empty($id) || empty($studentName) || empty($age)) {
    die("Insufficient Form Data");
  }

  $data = array(
    ":id" => $id,
    ":studentName" => $studentName,
    ":age" => $age
  );

  if ($action == "insert_record") {
    //insert record

    $statement = $pdo->prepare("INSERT INTO public.student (id, \"studentName\", age) VALUES (:id, :studentName, :age);");

    $statement->execute($data);


  } else if ($action == "update_record") {
    //udpate record 

    $statement = $pdo->prepare("UPDATE public.student SET \"studentName\" = :studentName, age = :age WHERE id = :id;");

    $statement->execute($data);

  }

  include("fetch_all_records.php");

} catch (PDOException $e) {
  echo $e->getMessage();
}