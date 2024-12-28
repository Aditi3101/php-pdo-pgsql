<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h2>Student List</h2>
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <form>
              <input type="hidden" id="action" name="action" value="insert_record">

              <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="number" class="form-control" id="id" name="id" placeholder="Id">
              </div>
              <div class="mb-3">
                <label for="studentName" class="form-label">Student Name</label>
                <input type="text" class="form-control" id="studentName" name="studentName" placeholder="Student Name">
              </div>
              <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" placeholder="Age">
              </div>
              <button type="submit" class="btn btn-danger">Submit Form</button>
            </form>
          </div>
        </div>

      </div>
      <div class="col-md-6 offset-md-2">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Student Name</th>
              <th scope="col">Age</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody id="studentList">
            <?php
            include("fetch_all_records.php");
            ?>

          </tbody>
        </table>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
  <script>
    //?SELECT$(document).ready(function () {
    $("form").submit(function (e) {
      e.preventDefault();

      let data = $(this).serialize();

      $.ajax({
        type: "POST",
        url: "upsert_record.php",
        data: data,
        success: function (response) {
          //update table
          $("#studentList").html(response);

          //clear form
          $("#action").val("insert_record");
          $("#id").val("");
          $("#studentName").val("");
          $("#age").val("");
        }
      });


    });

    $(document).on("click", "[id^=edit_]", function () {
      let id = $(this).attr("id").split("_")[1];

      let data = "id=" + id;

      $.ajax({
        type: "POST",
        url: "edit_get_record.php",
        data: data,
        success: function (response) {
          let student = JSON.parse(response);

          $("#action").val("update_record");
          $("#id").val(student.id);
          $("#studentName").val(student.studentName);
          $("#age").val(student.age);
        }
      });
    });

    $(document).on("click", "[id^=delete_]", function () {
      let id = $(this).attr("id").split("_")[1];
      let data = "id=" + id;

      $.ajax({
        type: "POST",
        url: "delete_record.php",
        data: data,
        success: function (response) {
          //update table
          $("#studentList").html(response);
        }
      });
    });
    //});
  </script>
</body>

</html>