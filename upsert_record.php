<!-- upsert means update or insert. This script will handle both insert and update operations. The script will be called when the form is submitted. The form data will be serialized and sent to this script. The script will then check if the action is insert or update. If the action is insert, the script will insert a new record. If the action is update, the script will update an existing record. After the insert or update operation is completed, the script will fetch all records and return the updated table to the client side. The client side will then update the table with the updated data. The form will be cleared after the operation is completed. -->

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
