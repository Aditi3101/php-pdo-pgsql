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