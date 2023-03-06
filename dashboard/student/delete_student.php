<?php
  include("../header.php");
  include("../../connection.php");

  if (1) {
      $s_id = $_POST["id"];
      // perform delete operation using $s_id
      if (isset($_GET["id"])) {
        // Retrieve s_id from URL parameter
        $s_id = $_GET["id"];
    
        // Delete student record from database
        $query = "DELETE FROM students WHERE s_id=$s_id";
        $result = mysqli_query($conn, $query);
    
        if ($result) {
            echo "<script type='text/javascript'>alert('Student information deleted successfully');window.location.href='all_student.php';</script>";
        } else {
            echo "Error deleting student record: " . mysqli_error($conn);
        }
    } else {
        echo "No s_id provided";
    }
    
    mysqli_close($conn);
  }
?>
