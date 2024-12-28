<?php

include("connect.php");

$id = $_POST["id"];

$statement = $pdo->prepare("DELETE FROM public.student WHERE id=$id;");
$statement->execute();

include("fetch_all_records.php");